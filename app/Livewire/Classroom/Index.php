<?php

namespace App\Livewire\Classroom;

use App\Livewire\Traits\Pagination;
use Livewire\Component;
use App\Models\Classroom;
use App\Livewire\Traits\Search;
use Livewire\Attributes\Locked;

class Index extends Component
{
    use Pagination, Search;

    #[Locked]
    public $columns;

    public function mount()
    {
        $this->setColumns();
    }

    private function setColumns()
    {
        $this->columns = [
            'ID',
            'Class Name',
            'Section',
            'Actions',
        ];
    }

    public function render()
    {
        return view('livewire.classroom.index', [
            'classrooms' => Classroom::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('section', 'like', '%'.$this->search.'%')
            ->paginate($this->perPage),
        ]);
    }
}
