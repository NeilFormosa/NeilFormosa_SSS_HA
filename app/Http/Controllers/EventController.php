<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Department;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display all events
    public function index(Request $request)
    {
        $query = Event::query()->with('department');

        // Apply sorting if requested
        if ($request->get('sort') === 'department') {
            $query->join('departments', 'events.department_id', '=', 'departments.id')
                ->orderBy('departments.name', 'asc')
                ->select('events.*');
        } else {
            $query->latest(); // default sorting
        }

        $events = $query->get();

        return view('events.index', compact('events'));
    }


    // Show form to create a new event
    public function create()
    {
        $departments = Department::all();
        return view('events.create', compact('departments'));
    }

    // Store a new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer_name' => 'required|string|max:255',
        ]);

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'date' => $request->date,
            'location' => $request->location,
            'organizer_name' => $request->organizer_name,
        ]);

        return redirect()->route('events.index')
                         ->with('success', 'Event created successfully');
    }

    // Show form to edit an event
    public function edit(Event $event)
    {
        $departments = Department::all();
        return view('events.edit', compact('event', 'departments'));
    }

    // Update an event
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer_name' => 'required|string|max:255',
        ]);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'date' => $request->date,
            'location' => $request->location,
            'organizer_name' => $request->organizer_name,
        ]);

        return redirect()->route('events.index')
                         ->with('success', 'Event updated successfully');
    }

    // Delete an event
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')
                         ->with('success', 'Event deleted successfully');
    }

    // Show a single event
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
