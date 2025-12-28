<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    // Display all attendees
    public function index()
    {
        $attendees = Attendee::with('event')->get();
        return view('attendees.index', compact('attendees'));
    }

    // Show form to create a new attendee
    public function create()
    {
        $events = Event::all();
        return view('attendees.create', compact('events'));
    }

    // Store a new attendee
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
            'event_id' => 'required|exists:events,id',
        ]);

        Attendee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'event_id' => $request->event_id,
        ]);

        return redirect()->route('attendees.index')
                         ->with('success', 'Attendee registered successfully');
    }

    // Show form to edit an attendee
    public function edit(Attendee $attendee)
    {
        $events = Event::all();
        return view('attendees.edit', compact('attendee', 'events'));
    }

    // Update an attendee
    public function update(Request $request, Attendee $attendee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'nullable|string|max:20',
            'event_id' => 'required|exists:events,id',
        ]);

        $attendee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'event_id' => $request->event_id,
        ]);

        return redirect()->route('attendees.index')
                         ->with('success', 'Attendee updated successfully');
    }

    // Delete an attendee
    public function destroy(Attendee $attendee)
    {
        $attendee->delete();
        return redirect()->route('attendees.index')
                         ->with('success', 'Attendee deleted successfully');
    }

    public function show(Attendee $attendee)
    {
        return view('attendees.show', compact('attendee'));
    }
}
