<?php

namespace App\Livewire\Subject;

use App\Models\Subject;
use Livewire\Component;
use App\Models\Classroom;
use App\Livewire\Traits\Search;
use Livewire\Attributes\Locked;
use App\Livewire\Traits\Pagination;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        $query = Subject::with('classroom', 'teacher');

        if ($user->is_superuser) {

        }

        elseif ($user->hasAccess('view_classrooms_as_hod'))
        {
            $classroomIds = Classroom::where('head_of_department_id', $user->id)->pluck('id');
            $query->whereIn('classroom_id', $classroomIds);
        }

        else {
            $query->where('teacher_id', $user->id);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('classroom', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('section', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('teacher', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        return view('livewire.subject.index', [
            'subjects' => $query->paginate($this->perPage),
        ]);
    }
}
