<?php

namespace App\Livewire\Subject;

use App\Models\Subject;
use Livewire\Component;
use App\Livewire\Traits\Search;
use Livewire\Attributes\Locked;
use App\Livewire\Traits\Pagination;

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
            'Subject Name',
            'Class Name',
            'Teacher Name',
            'Actions',
        ];
    }

    public function delete(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.index')->with('alert', 'Subject successfully deleted!');
    }

    public function render()
    {
        return view('livewire.subject.index', [
            'subjects' => Subject::with('classroom', 'teacher')
                ->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('classroom', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('section', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('teacher', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        });
                })
                ->paginate($this->perPage),
        ]);
    }
}
