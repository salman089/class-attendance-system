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
    public $name, $email, $phone, $date_of_birth, $gender;
    public $address_line_1, $address_line_2, $city, $state, $postcode, $country;
    public $password, $password_confirmation;
    public $is_active;
    public $selectedRoleID;
    public $roles;

    public function mount(User $user = null)
    {
        $this->user = $user ?? new User();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->address_line_1 = $user->address_line_1;
        $this->address_line_2 = $user->address_line_2;
        $this->city = $user->city;
        $this->state = $user->state;
        $this->postcode = $user->postcode;
        $this->country = $user->country;
        $this->phone = $user->phone;
        $this->date_of_birth = $user->date_of_birth;
        $this->gender = $user->gender;
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
            'address_line_1' => ['required', 'max:100'],
            'address_line_2' => ['nullable', 'max:100'],
            'city' => ['required', 'max:50'],
            'state' => ['required', 'max:50'],
            'postcode' => ['required', 'max:20'],
            'country' => ['required', 'max:50'],
            'phone' => ['required', 'max:20'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'max:10', 'in:male,female'],
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
        $this->user->address_line_1 = $this->address_line_1;
        $this->user->address_line_2 = $this->address_line_2;
        $this->user->city = $this->city;
        $this->user->state = $this->state;
        $this->user->postcode = $this->postcode;
        $this->user->country = $this->country;
        $this->user->phone = $this->phone;
        $this->user->date_of_birth = $this->date_of_birth;
        $this->user->gender = $this->gender;
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
