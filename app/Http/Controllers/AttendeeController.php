<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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

        // Call external email validation API
        $apiKey = config('services.abstract_email.key');

        $response = Http::get('https://emailreputation.abstractapi.com/v1/', [
            'api_key' => $apiKey,
            'email' => $request->email,
        ]);

        // Safety check (API failed)
        if ($response->failed()) {
                return back()
                    ->withInput()
                    ->withErrors(['email' => 'Email validation service is unavailable. Please try again later.']);
            }

        $data = $response->json();

        // Check deliverability
        $isDeliverable = $data['email_deliverability']['status'] === 'deliverable';

        if (!$isDeliverable) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'This email is not valid or deliverable.']);
        }

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

        // Call external email validation API
        $apiKey = config('services.abstract_email.key');

        $response = Http::get('https://emailreputation.abstractapi.com/v1/', [
            'api_key' => $apiKey,
            'email' => $request->email,
        ]);

        // Safety check (API failed)
        if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Email validation service is unavailable. Please try again later.']);
        }

        $data = $response->json();

        // Check deliverability
        $isDeliverable = $data['email_deliverability']['status'] === 'deliverable';

        if (!$isDeliverable) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'This email is not valid or deliverable.']);
        }

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
