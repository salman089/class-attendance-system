<?php

namespace App\Livewire\Attendance;

use Carbon\Carbon;
use App\Models\Subject;
use Livewire\Component;
use App\Models\Classroom;
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
            $this->date = now()->toDateString('m/d/Y');
        }
    }

    public function getFormattedDateProperty()
    {
        return Carbon::parse($this->date)->format('M d, Y');
    }

    protected function getFilteredQuery()
    {
        return Attendance::with(['student.user', 'subject', 'marker'])
            ->when($this->date, fn($q) => $q->whereDate('date', $this->date))
            ->latest();
    }

    public function render()
    {
        $user = auth()->user();

        $query = Subject::with('classroom', 'teacher');

        if ($user->hasAccess('admin_dashboard')) {
        } elseif ($user->hasAccess('view_classrooms_as_hod')) {
            $classroomIds = Classroom::where('head_of_department_id', $user->id)->pluck('id');
            $query->whereIn('classroom_id', $classroomIds);
        } else {
            $query->where('teacher_id', $user->id);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('classroom', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('section', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('teacher', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        $subjects = $query->paginate($this->perPage);

        return view('livewire.attendance.index', compact('subjects'));
    }

    private function getFilteredAttendances($date)
    {
        $user = auth()->user();

        $query = Attendance::with(['student', 'subject.classroom', 'marker'])
            ->whereDate('date', $date);

        if ($user->hasAccess('admin_dashboard') || $user->is_superuser) {
            return $query->get();
        }

        if ($user->hasAccess('view_classrooms_as_hod')) {
            $classroomIds = Classroom::where('head_of_department_id', $user->id)->pluck('id');
            return $query->whereHas(
                'subject',
                fn($q) =>
                $q->whereIn('classroom_id', $classroomIds)
            )->get();
        }

        // Teacher case
        return $query->whereHas(
            'subject',
            fn($q) =>
            $q->where('teacher_id', $user->id)
        )->get();
    }

    public function exportExcel(Request $request)
    {
        abort_unless(auth()->user()->hasAccess('export_attendance'), 403);

        $date = $request->input('date', now()->toDateString());

        $attendances = $this->getFilteredAttendances($date);

        return Excel::download(new AttendanceExport($attendances), 'attendance.xlsx');
    }


    public function exportPDF(Request $request)
    {
        abort_unless(auth()->user()->hasAccess('export_attendance'), 403);

        $date = $request->input('date', now()->toDateString());

        $attendances = $this->getFilteredAttendances($date);

        $pdf = Pdf::loadView('exports.attendance_pdf', ['attendances' => $attendances]);

        return response()->streamDownload(fn() => print($pdf->stream()), 'attendance.pdf');
    }
}
