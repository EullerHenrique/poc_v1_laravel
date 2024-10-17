<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function index()
    {
        return view('login.index');
    }

    public function store()
    {
        if(!Auth::attempt(request()->only(['email', 'password']))) {
            return redirect()->back()->withErrors('Usuário e/ou senha incorretos');
        }
    }

}