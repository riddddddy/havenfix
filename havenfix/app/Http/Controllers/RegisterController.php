<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.registration.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        //validate
        $attributes = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        //user role_id == 1
        // $attributes['role_id'] = 1 ;

        if ($request->has('profile_picture')) {
            $attributes['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $attributes['profile_picture'] = 'profile_pictures/avatar.png';
        }


        $user = User::create($attributes);
        // Auth::login($user);
        if (!Auth::attempt($attributes)) {
            return back()
                ->withInput() // keeps old input except password
                ->withErrors([
                    'email' => 'The provided credentials are incorrect. Please double-check your email.',
                    'password' => 'The password you have provided do not match.'
                ]);
        }

        //redirect
        return redirect()->route('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
