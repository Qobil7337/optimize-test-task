<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
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
    public function store(Request $request, Lead $lead)
    {
        $this->authorize('update', $lead);

        $request->validate([
            'title' => 'required|min:3',
            'due_at' => 'nullable|date',
            'is_done' => 'sometimes|boolean',
        ]);

        $lead->tasks()->create($request->only('title', 'due_at', 'is_done'));

        return back()->with('success', 'Task created.');
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
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task->lead);

        $request->validate([
            'title' => 'required|min:3',
            'due_at' => 'nullable|date',
            'is_done' => 'sometimes|boolean',
        ]);

        $task->update($request->only('title', 'due_at', 'is_done'));

        return back()->with('success', 'Task updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task->lead);
        $task->delete();

        return back()->with('success', 'Task deleted.');
    }
}
