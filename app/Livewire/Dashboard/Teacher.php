<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class Teacher extends Component
{
    public $totalSubjects, $totalClassrooms, $totalStudents;
    public $weeklyData = [];
    public $recentAttendances = [];

    public function mount()
    {
        $teacher = Auth::user();

        $this->totalSubjects = Subject::where('teacher_id', $teacher->id)->count();
        $this->totalClassrooms = Subject::where('teacher_id', $teacher->id)->distinct('classroom_id')->count();

        $this->totalStudents = Attendance::whereHas('subject', fn($q) =>
            $q->where('teacher_id', $teacher->id))->distinct('student_id')->count();

        $this->weeklyData = Attendance::whereHas('subject', fn($q) =>
            $q->where('teacher_id', $teacher->id))
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->get()
            ->groupBy('status')
            ->map(fn($group) => $group->count());

        $this->recentAttendances = Attendance::whereHas('subject', fn($q) =>
            $q->where('teacher_id', $teacher->id))
            ->with('student', 'subject')
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.teacher')->layout('layouts.app');
    }
}
