<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        //Query Builder
        // Raw database query
        // return view('tasks.index', compact('tasks'));
        // return view('tasks.index',[''=> $tasks]);
            return view('tasks.index')->with('tasks', $tasks);
        
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
        ]);
        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(string $id)
    {
        $task = Task::find($id);
        return view('tasks.show', compact('task'));
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}