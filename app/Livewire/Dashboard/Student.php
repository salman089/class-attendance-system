<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Student extends Component
{
    public $totalSubjects;
    public $weeklyData = [];
    public $recentAttendances = [];

    public function mount()
    {
        $student = Auth::user();

        $this->totalSubjects = $student->classroom_id
            ? $student->classroom->subjects->count()
            : 0;

        $this->weeklyData = $this->getWeeklyAttendance($student->id);
        $this->recentAttendances = Attendance::with('subject')
            ->where('student_id', $student->id)
            ->latest()
            ->take(5)
            ->get();
    }

    protected function getWeeklyAttendance($studentId)
    {
        $start = now()->subDays(6)->startOfDay();

        return Attendance::where('student_id', $studentId)
            ->where('date', '>=', $start)
            ->get()
            ->groupBy(fn($a) => Carbon::parse($a->date)->format('D'))
            ->map(fn($group) => $group->count());
    }

    public function render()
    {
        return view('livewire.dashboard.student')->layout('layouts.app');
    }
}
