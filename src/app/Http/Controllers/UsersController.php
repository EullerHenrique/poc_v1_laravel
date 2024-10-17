<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = User::create($data);
        Auth::login($user);
        return to_route('series.index');
    }
}
