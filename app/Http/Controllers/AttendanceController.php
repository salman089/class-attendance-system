<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $subjects = Subject::with('classroom')->get();

        return view('attendances.index', [
            'subjects' => $subjects,
            'date' => $date,
        ]);
    }

    public function mark($subjectId, $date)
    {
        return view('attendances.mark', [
            'subjectId' => $subjectId,
            'date' => $date,
        ]);
    }

    public function show($subjectId, $date)
    {
        $subject = Subject::with('classroom.students')->findOrFail($subjectId);
        $students = $subject->classroom?->students ?? [];

        $statuses = Attendance::where('subject_id', $subjectId)
            ->where('date', $date)
            ->pluck('status', 'student_id');

        return view('attendances.show', compact('subject', 'students', 'statuses', 'date'));
    }
}
