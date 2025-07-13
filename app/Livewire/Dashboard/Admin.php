<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Attendance;
use Livewire\Component;

class Admin extends Component
{
    public function render()
    {
        $totalUsers = User::count();
        $totalStudents = User::withRole('student')->count();
        $totalTeachers = User::withRole('teacher')->count();
        $totalClassrooms = Classroom::count();
        $totalSubjects = Subject::count();

        $weeklyData = Attendance::selectRaw("status, COUNT(*) as count")
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('status')
            ->pluck('count', 'status');

        $monthlyData = Attendance::selectRaw("MONTH(date) as month, COUNT(*) as count")
            ->whereYear('date', now()->year)
            ->groupByRaw("MONTH(date)")
            ->pluck('count', 'month');

        $recentAttendances = Attendance::with(['student', 'subject'])->latest()->take(5)->get();

        return view('livewire.dashboard.admin', compact(
            'totalUsers',
            'totalStudents',
            'totalTeachers',
            'totalClassrooms',
            'totalSubjects',
            'weeklyData',
            'monthlyData',
            'recentAttendances'
        ))->layout('layouts.app');
    }
}
