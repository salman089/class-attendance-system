<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        return view('classrooms.index');
    }

    public function create()
    {
        return view('classrooms.create');
    }

    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', [
            'classroom' => $classroom
        ]);
    }

    public function show(Classroom $classroom)
    {
        return view('classrooms.show', [
            'classroom' => $classroom
        ]);
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        return redirect()->route('classroom.index')->with('alert', 'Classroom successfully deleted!');
    }
}
