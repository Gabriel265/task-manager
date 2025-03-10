<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Import Task model
use App\Models\Project; // Import Project model

class TaskController extends Controller
{
    public function index()
{
    $projects = Project::all();
    $selectedProjectId = request('project_id');
    $selectedProject = $selectedProjectId ? Project::find($selectedProjectId) : null;

    $tasks = Task::when($selectedProjectId, function ($query) use ($selectedProjectId) {
        return $query->where('project_id', $selectedProjectId);
    })->orderBy('priority')->get();

    return view('tasks.index', compact('tasks', 'projects', 'selectedProject'));
}

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Task::create($request->all());
        return redirect()->route('tasks.index');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate(['name' => 'required']);
        $task->update($request->all());
        return redirect()->route('tasks.index');
    }
	public function edit(Task $task)
    {
        $projects = Project::all(); // Fetch all projects for the dropdown
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }


    public function reorder(Request $request)
    {
        foreach ($request->order as $order) {
            Task::where('id', $order['id'])->update(['priority' => $order['position']]);
        }
        return response()->json(['success' => true]);
    }
}