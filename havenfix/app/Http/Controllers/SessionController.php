<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login.login');
    }

    public function store(Request $request){
        //validate
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //login the user

        if(!Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'Sorry credentials do not match'
            ]);
        };

        //regenerate the session token
        request()->session()->regenerate();

        return redirect()->route('/');

    }

    public function destroy(){
        Auth::logout();
        return redirect()->route('/');
    }
}
