<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('subjects.index');
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit',[
            'subject' => $subject,
        ]);
    }

    public function show(Subject $subject)
    {
        return view('subjects.show',[
            'subject' => $subject
        ]);
    }
}
