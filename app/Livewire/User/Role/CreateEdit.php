<?php

namespace App\Livewire\User\Role;

use App\Models\Role;
use Livewire\Component;
use App\Models\PermissionCategory;
use Illuminate\Support\Facades\DB;

class CreateEdit extends Component
{
    public $role;
    public $name;
    public $permissionCategories;
    public $selectedPermissions;

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;

        $this->permissionCategories = PermissionCategory::all();

        $this->selectedPermissions = $role->permissions()->pluck('permissions.id')->toArray();
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $this->role->id],
            'selectedPermissions' => ['required', 'array', 'min:1'],
            'selectedPermissions.*' => ['required', 'integer',  'exists:permissions,id'],
        ];
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            $this->role->name = $this->name;
            $this->role->save();

            $this->role->permissions()->sync($this->selectedPermissions);
        });

        session()->flash('success', 'Role successfully saved!');
        return redirect()->route('user.role.index');
    }

    protected function messages()
    {
        return [
            'selectedPermissions.required' => 'At least one permission must be selected.',
        ];
    }

    public function render()
    {
        return view('livewire.user.role.create-edit');
    }
}
