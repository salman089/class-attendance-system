<?php

namespace App\Livewire\Attendance;

use App\Models\Subject;
use Livewire\Component;
use App\Models\Classroom;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class Reports extends Component
{
    public $fromDate;
    public $toDate;
    public $classroomId;
    public $subjectId;
    public $attendances = [];

    public function mount()
    {
        $this->fromDate = now()->startOfMonth()->toDateString();
        $this->toDate = now()->toDateString();
        $this->loadAttendances();
    }

    public function updated($property)
    {
        $this->loadAttendances();
    }

    public function loadAttendances()
    {
        $user = auth()->user();

        $query = Attendance::with(['student', 'subject', 'classroom', 'marker'])
            ->when($this->fromDate, fn($q) => $q->whereDate('date', '>=', $this->fromDate))
            ->when($this->toDate, fn($q) => $q->whereDate('date', '<=', $this->toDate));

        if ($user->hasAccess('admin_dashboard')) {
        } elseif ($user->hasAccess('view_classrooms_as_hod')) {
            $classroomIds = Classroom::where('head_of_department_id', $user->id)->pluck('id');
            $query->whereIn('classroom_id', $classroomIds);
        } else {
            $subjectIds = Subject::where('teacher_id', $user->id)->pluck('id');
            $query->whereIn('subject_id', $subjectIds);
        }

        if ($this->classroomId) {
            $query->where('classroom_id', $this->classroomId);
        }

        if ($this->subjectId) {
            $query->where('subject_id', $this->subjectId);
        }

        $this->attendances = $query->latest()->get();
    }

    public function getClassroomsProperty()
    {
        $user = auth()->user();

        if ($user->hasAccess('admin_dashboard')) {
            return Classroom::orderBy('name')->get();
        }

        if ($user->hasAccess('view_classrooms_as_hod')) {
            return Classroom::where('head_of_department_id', $user->id)->orderBy('name')->get();
        }

        return Classroom::whereHas('subjects', fn($q) => $q->where('teacher_id', $user->id))
            ->orderBy('name')
            ->get();
    }

    public function getSubjectsProperty()
    {
        $user = auth()->user();

        if ($user->hasAccess('admin_dashboard')) {
            return Subject::orderBy('name')->get();
        }

        if ($user->hasAccess('view_classrooms_as_hod')) {
            $classroomIds = Classroom::where('head_of_department_id', $user->id)->pluck('id');
            return Subject::whereIn('classroom_id', $classroomIds)->orderBy('name')->get();
        }

        return Subject::where('teacher_id', $user->id)->orderBy('name')->get();
    }


    public function exportPDF()
    {
        abort_unless(auth()->user()->hasAccess('export_attendance'), 403);

        $pdf = Pdf::loadView('exports.attendance_pdf', ['attendances' => $this->attendances]);
        return response()->streamDownload(fn() => print($pdf->stream()), 'attendance-report.pdf');
    }

    public function exportExcel()
    {
        abort_unless(auth()->user()->hasAccess('export_attendance'), 403);

        return Excel::download(new AttendanceExport($this->attendances), 'attendance-report.xlsx');
    }


    public function render()
    {
        return view('livewire.attendance.reports');
    }
}
