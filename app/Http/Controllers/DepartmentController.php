<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    //Display a list of departments
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    //Show the form to create a new department
    public function create()
    {
        return view('departments.create');
    }

    //Store a new department in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Department::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('departments.index')
                         ->with('success', 'Department created successfully');
    }

    //Show the form to edit a department
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    //Update a department
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('departments.index')
                         ->with('success', 'Department updated successfully');
    }

    //Delete a department
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Department deleted successfully');
    }
}
