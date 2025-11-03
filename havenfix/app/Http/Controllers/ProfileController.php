<?php

namespace App\Http\Controllers;

use App\Models\Fault;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $faultsReported = Fault::where('user_id', $user->id)->get();
        $countFaults = Fault::withTrashed()->where('user_id', $user->id)->count();
        $allFaultsReported = Fault::orderby('created_at')->get();
        
        //for admin
        $allFaultsReportedCount = Fault::withTrashed()->count();
        $pendingFaultsCount = Fault::where('status', 'Pending')->count();
        
        $allFaults2025 = Fault::withTrashed()->whereBetween('created_at', [
            Carbon::create(2025)->startOfYear(),
            Carbon::create(2025)->endOfYear()
        ])->get();

        $faultsMonthCount = Fault::withTrashed()->whereBetween('created_at', [
            Carbon::create(now())->startOfMonth(),
            Carbon::create(now())->endOfMonth()
        ])->count();

        return view('main.profile.show', compact('user', 'faultsReported', 'countFaults', 'allFaultsReported', 'allFaultsReportedCount', 'pendingFaultsCount', 'faultsMonthCount' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user)
    {

        return view('main.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['nullable', 'confirmed', Password::min(8)->letters()->numbers()],
            'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if($request->has('profile_picture')){
            $attributes['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        if ($request->filled('password')) {
            $attributes['password'] = Hash::make($request->password);
        } else {
            unset($attributes['password']);
        }

        $user->update($attributes);

        return redirect()->route('user.show', $user)->with(["message" => 'You have successfully updated the changes']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
