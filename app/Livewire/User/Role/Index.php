<?php

namespace App\Livewire\User\Role;

use App\Models\Role;
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
            'Created At',
            'Updated At',
            'Actions',
        ];
    }

    public function delete(Role $role)
    {
        $role->delete();
        session()->flash('alert', 'Role successfully deleted!');
    }

    public function render()
    {
        return view('livewire.user.role.index', [
            'roles' => Role::query()
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate($this->perPage),
        ]);
    }
}
