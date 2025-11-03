<?php

namespace App\Http\Controllers;

use App\Models\Fault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaultsController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Fault $fault)
    {
        $faults = Fault::with(['user', 'workSummaries'])->get();

        return view('main.faults.index', compact('faults'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('main.faults.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $attributes = $request->validate([
            'item' => ['required'],
            // 'location' => ['required'],
            'description' => ['required'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'block' => ['required'],
            'level' => ['required'],
        ]);

        $user = Auth::user();

        $attributes['user_id'] = $user->id;
        $attributes['status'] = 'Pending';


        if ($request->has('image')) {
            $attributes['image'] = $request->file('image')->store('faults', 'public');
        };

        Fault::create($attributes);

        return redirect()->route('faults.index')->with(['message' => "You have sucessfully submitted the fault. We will look into it soon."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fault $fault)
    {
        return view('main.faults.show', compact('fault'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fault $fault)
    {
        return view('main.faults.edit', compact('fault'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fault $fault)
    {

        $attributes = $request->validate([
            'item' => ['required'],
            'description' => ['required'],
            // 'location' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'status' => ['required'],
            'block' => ['required'],
            'level' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('faults', 'public');
        }

        $attributes['user_id'] = auth()->user()->id;

        $fault->update($attributes);

        return redirect()->route('faults.index')->with(['message' => 'You have updated the fault "' . $fault->item . '" successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Fault $fault)
    {
        $fault->delete();
        return redirect()->back()->with('message', 'Fault "' . $fault->item .  '" deleted successfully.');
    }
}
