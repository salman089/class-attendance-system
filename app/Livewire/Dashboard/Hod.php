<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class Hod extends Component
{
    public $totalStudents, $totalTeachers, $totalSubjects, $totalClassrooms;
    public $weeklyData = [];
    public $recentAttendances = [];

    public function mount()
    {
        $user = Auth::user();

        $classroomIds = Classroom::where('head_of_department_id', $user->id)->pluck('id');

        $this->totalClassrooms = $classroomIds->count();

        $this->totalSubjects = Subject::whereIn('classroom_id', $classroomIds)->count();

        $this->totalTeachers = User::whereHas(
            'subjectsTaught',
            fn($q) => $q->whereIn('classroom_id', $classroomIds))->distinct()->count();

        $this->totalStudents = User::whereHas('roles', fn($q) => $q->where('name', 'student'))
            ->whereIn('classroom_id', $classroomIds)
            ->count();

        $this->weeklyData = $this->getWeeklyAttendance($classroomIds);

        $this->recentAttendances = Attendance::with('student', 'subject')
            ->whereHas('subject', fn($q) => $q->whereIn('classroom_id', $classroomIds))
            ->latest()
            ->take(5)
            ->get();
    }

    protected function getWeeklyAttendance($classroomIds)
    {
        $week = now()->subDays(6)->startOfDay();

        return Attendance::whereHas(
            'subject',
            fn($q) =>
            $q->whereIn('classroom_id', $classroomIds)
        )
            ->where('date', '>=', $week)
            ->get()
            ->groupBy(fn($a) => \Carbon\Carbon::parse($a->date)->format('D'))
            ->map(fn($day) => $day->count());
    }

    public function render()
    {
        return view('livewire.dashboard.hod')->layout('layouts.app');
    }
}
