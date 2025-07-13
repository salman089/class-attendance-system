<?php

namespace App\Livewire\Attendance;

use App\Models\Subject;
use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Livewire\Traits\Search;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AttendanceExport;
use App\Livewire\Traits\Pagination;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;


class Index extends Component
{
    use Search, Pagination;

    public $date;

    public function mount($date = null)
    {
        $this->date = $date ?? now()->toDateString();
    }

    public function updatedDate($value)
    {
        if (empty($value)) {
            $this->date = now()->toDateString();
        }
    }

    protected function getFilteredQuery()
    {
        return Attendance::with(['student.user', 'subject', 'marker'])
            ->when($this->date, fn($q) => $q->whereDate('date', $this->date))
            ->latest();
    }

    public function render()
    {
        $subjects = Subject::with('classroom')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('classroom', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('section', 'like', '%' . $this->search . '%');
                    });
            })
            ->paginate($this->perPage);

        return view('livewire.attendance.index', compact('subjects'));
    }

    public function exportExcel(Request $request)
    {
        abort_unless(auth()->user()->hasAccess('export_attendance'), 403);

        $date = $request->input('date', now()->toDateString());

        $attendances = Attendance::with(['student', 'subject', 'marker'])
            ->whereDate('date', $date)
            ->get();

        return Excel::download(new AttendanceExport($attendances), 'attendance.xlsx');
    }

    public function exportPDF(Request $request)
    {
        abort_unless(auth()->user()->hasAccess('export_attendance'), 403);

        $date = $request->input('date', now()->toDateString());

        $attendances = Attendance::with(['student', 'subject', 'marker'])
            ->whereDate('date', $date)
            ->get();

        $pdf = Pdf::loadView('exports.attendance_pdf', ['attendances' => $attendances]);

        return response()->streamDownload(fn() => print($pdf->stream()), 'attendance.pdf');
    }
}
