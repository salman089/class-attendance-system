<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Subject;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $formattedDate = Carbon::parse($date)->format('M d, Y');
        $subjects = Subject::with('classroom')->get();

        return view('attendances.index', [
            'subjects' => $subjects,
            'date' => $date,
            'formattedDate' => $formattedDate,
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
        $formattedDate = Carbon::parse($date)->format('M d, Y');
        $students = $subject->classroom?->students ?? [];

        $statuses = Attendance::where('subject_id', $subjectId)
            ->where('date', $date)
            ->pluck('status', 'student_id');

        return view('attendances.show',[
            'subject' => $subject,
            'date' => $date,
            'formattedDate' => $formattedDate,
            'students' => $students,
            'statuses' => $statuses
        ]);
    }

    public function report(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $classroomId = $request->input('classroom_id');
        $subjectId = $request->input('subject_id');

        return view('attendances.reports', [
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'classroomId' => $classroomId,
            'subjectId' => $subjectId,
        ]);
    }
}
