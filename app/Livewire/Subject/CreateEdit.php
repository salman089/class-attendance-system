<?php

namespace App\Livewire\Subject;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\User;

class CreateEdit extends Component
{
    public Subject $subject;
    public $name;
    public $description;
    public $subject_code;
    public $classroom_id;
    public $teacher_id;

    public $classrooms;
    public $teachers;

    public function mount(Subject $subject)
    {
        $this->subject = $subject;
        $this->name = $subject->name;
        $this->description = $subject->description;
        $this->subject_code = $subject->subject_code;
        $this->classroom_id = $subject->classroom_id;
        $this->teacher_id = $subject->teacher_id;

        $this->classrooms = Classroom::all();

        $this->teachers = User::withRole(['Teacher', 'Head of Department'])->get();
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'max:25'],
            'description' => ['nullable', 'max:500'],
            'subject_code' => ['nullable', 'max:25'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'teacher_id' => ['required', 'exists:users,id'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->subject->name = $this->name;
        $this->subject->description = $this->description;
        $this->subject->subject_code = $this->subject_code;
        $this->subject->classroom_id = $this->classroom_id;
        $this->subject->teacher_id = $this->teacher_id;

        $this->subject->save();

        session()->flash('success', 'Subject successfully saved!');
        return redirect()->route('subject.index');
    }

    public function render()
    {
        return view('livewire.subject.create-edit');
    }
}
