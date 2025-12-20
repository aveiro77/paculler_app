<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Employee;
use App\Models\Item;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('employee')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $employees = Employee::all();
        $items = Item::all();
        return view('projects.create', compact('employees', 'items'));
    }

    public function show(Project $project)
    {
        $project->load('employee');
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $employees = Employee::all();
        $items = Item::all();
        return view('projects.edit', compact('project', 'employees', 'items'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
            'employee_id' => 'required|exists:employees,id',
            'project_details' => 'required|array',
            'project_details.*.item_id' => 'required|exists:items,id',
            'project_details.*.quantity' => 'required|numeric|min:1',
            'project_details.*.rate' => 'required|numeric|min:0',
        ]);

        $project->update($request->only(['name', 'description', 'date', 'status', 'employee_id']));

        $project->projectDetails()->delete(); // Soft delete existing

        foreach ($request->project_details as $detail) {
            $project->projectDetails()->create($detail);
        }

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
