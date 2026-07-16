<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|string|max:255',
        ]);

        Task::create([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'status' => 'todo',
        ]);

        return redirect()->route('projects.show', $request->project_id)->with('success', 'Task Berhasil Ditambahkan!');
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
        $request->validate([
            'status' => 'required|in:todo,in_progress,done',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('projects.show', $task->project_id)->with('success', 'Status Task Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $project_id = $task->project_id;
        $task->delete();

        return redirect()->route('projects.show', $project_id)->with('success', 'Task Berhasil Diperbarui');
    }
}
