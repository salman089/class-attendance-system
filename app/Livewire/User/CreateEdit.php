<?php

namespace App\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateEdit extends Component
{
    public $user;
    public $name;
    public $email;
    public $address;
    public $phone;
    public $date_of_birth;
    public $is_active;
    public $password;
    public $password_confirmation;
    public $selectedRoleID;
    public $roles;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->phone = $user->phone;
        $this->date_of_birth = $user->date_of_birth;
        $this->is_active = $user->exists ? (bool) $user->is_active : false;
        $this->password = '';
        $this->password_confirmation = '';

        $this->roles = Role::with('permissions.category')->get();
        $this->selectedRoleID = $this->user->roles->first()?->id;
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email', 'max:25'],
            'address' => ['required', 'max:500'],
            'phone' => ['required', 'max:20'],
            'date_of_birth' => ['required', 'date'],
            'is_active' => ['nullable', 'boolean'],
            'selectedRoleID' => ['required', 'integer', 'exists:roles,id'],
        ];

        if (!$this->user->exists) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        } elseif (!empty($this->password)) {
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    public function save()
    {
        $this->validate();

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->address = $this->address;
        $this->user->phone = $this->phone;
        $this->user->date_of_birth = $this->date_of_birth;
        $this->user->is_active = sanitiseBoolean($this->is_active);

        if (!empty($this->password)) {
            $this->user->password = Hash::make($this->password);
        }

        DB::transaction(function () {
            $this->user->save();
            $this->user->roles()->sync([$this->selectedRoleID]);
        });

        session()->flash('success', 'User successfully saved!');
        return redirect()->route('user.index');
    }


    public function render()
    {
        return view('livewire.user.create-edit');
    }
}
