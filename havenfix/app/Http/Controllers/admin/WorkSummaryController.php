<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fault;
use App\Models\WorkSummary;
use Illuminate\Http\Request;

class WorkSummaryController
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
    public function create(Request $request)
    {
        $fault = Fault::findOrFail($request->fault_id);
        return view('admin.work-summary.create', compact('fault'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'remarks' => ['required'],
            'fault_id' => ['required'],
        ]);

        $attributes['user_id'] = auth()->user()->id;

        WorkSummary::create($attributes);

        return redirect()->route('faults.index')->with(['message' => 'You have submitted a remark in the Work Summary.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkSummary $workSummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkSummary $workSummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkSummary $workSummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkSummary $workSummary)
    {
        //
    }
}
