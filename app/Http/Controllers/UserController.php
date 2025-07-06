<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }
}
