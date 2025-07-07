<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return view('users.roles.index');
    }

    public function create(){
        return view('users.roles.create');
    }

    public function edit(Role $role){
        return view('users.roles.edit', [
            'role' => $role
        ]);
    }

    public function show(Role $role){
        return view('users.roles.show', [
            'role' => $role
        ]);
    }
}
