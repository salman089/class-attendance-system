<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasAccess('admin_dashboard')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasAccess('hod_dashboard')) {
            return redirect()->route('hod.dashboard');
        }

        if ($user->hasAccess('teacher_dashboard')) {
            return redirect()->route('teacher.dashboard');
        }

        if ($user->hasAccess('student_dashboard')) {
            return redirect()->route('student.dashboard');
        }

        abort(403, 'Unauthorized access.');
    }
}
