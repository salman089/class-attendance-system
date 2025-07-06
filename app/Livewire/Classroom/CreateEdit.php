<?php

namespace App\Livewire\Classroom;

use Livewire\Component;
use App\Models\Classroom;

class CreateEdit extends Component
{
    public Classroom $classroom;
    public $name;
    public $section;

    public function mount(Classroom $classroom)
    {
        $this->classroom = $classroom;
        $this->name = $classroom->name;
        $this->section = $classroom->section;
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'max:25'],
            'section' => ['required', 'max:25'],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->classroom->name = $this->name;
        $this->classroom->section = $this->section;
        $this->classroom->save();

        session()->flash('success', 'Class successfully saved!');
        return redirect()->route('classroom.index');
    }

    public function render()
    {
        return view('livewire.classroom.create-edit');
    }
}
