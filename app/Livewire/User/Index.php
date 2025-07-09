<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Models\User;
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
            'Name',
            'Email',
            'Phone',
            'Role',
            'Actions',
        ];
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('alert', 'User successfully deleted!');
    }

    public function render()
    {
        $query = User::with('roles')
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });

        if ($this->filter !== 'All') {
            $query->whereHas('roles', function ($q) {
                $q->where('name', $this->filter);
            });
        }

        return view('livewire.user.index', [
            'users' => $query->paginate($this->perPage),
            'roles' => Role::all(),
        ]);
    }
}
