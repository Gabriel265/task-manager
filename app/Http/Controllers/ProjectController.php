<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; // Import Project model

class ProjectController extends Controller
{
    public function index()
{
    $projects = Project::all();
    return view('projects.index', compact('projects'));
}

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Project::create($request->all());
        return redirect()->route('projects.index');
    }

	public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

	public function update(Request $request, Project $project)
    {
        $request->validate(['name' => 'required']);
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

	public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}