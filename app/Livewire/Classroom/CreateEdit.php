<?php

namespace App\Livewire\Classroom;

use App\Models\User;
use Livewire\Component;
use App\Models\Classroom;

class CreateEdit extends Component
{
    public Classroom $classroom;
    public $name;
    public $section;
    public $head_of_department_id;

    public $head_of_departments;

    public function mount(Classroom $classroom)
    {
        $this->classroom = $classroom;
        $this->name = $classroom->name;
        $this->section = $classroom->section;
        $this->head_of_department_id = $classroom->head_of_department_id;

        $this->head_of_departments = User::withRole(['Head of Department'])->get();

    }

    protected function rules()
    {
        return [
            'name' => ['required', 'max:25'],
            'section' => ['required', 'max:25'],
            'head_of_department_id' => ['nullable', 'exists:users,id'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->classroom->name = $this->name;
        $this->classroom->section = $this->section;
        $this->classroom->head_of_department_id = $this->head_of_department_id;
        $this->classroom->save();

        session()->flash('success', 'Class successfully saved!');
        return redirect()->route('classroom.index');
    }

    public function render()
    {
        return view('livewire.classroom.create-edit');
    }
}
