<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Department;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //Display all events
    public function index()
    {
        $events = Event::with('department')->get();
        return view('events.index', compact('events'));
    }

    //Show form to create a new event
    public function create()
    {
        $departments = Department::all();
        return view('events.create', compact('departments'));
    }

    //Store a new event
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'date' => 'required|date',
        ]);

        Event::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'date' => $request->date,
        ]);

        return redirect()->route('events.index')
                         ->with('success', 'Event created successfully');
    }

    //Show form to edit an event
    public function edit(Event $event)
    {
        $departments = Department::all();
        return view('events.edit', compact('event', 'departments'));
    }

    //Update an event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'date' => 'required|date',
        ]);

        $event->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'date' => $request->date,
        ]);

        return redirect()->route('events.index')
                         ->with('success', 'Event updated successfully');
    }

    //Delete an event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')
                         ->with('success', 'Event deleted successfully');
    }
}
