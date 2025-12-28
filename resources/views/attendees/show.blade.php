@extends('layouts.app')

@section('title', 'Attendee Details')

@section('content')
<h1 class="mb-3">Attendee Details</h1>

<div class="card">
    <div class="card-header bg-warning">
        {{ $attendee->name }}
    </div>
    <div class="card-body">
        <p><strong>Email:</strong> {{ $attendee->email }}</p>
        <p><strong>Phone:</strong> {{ $attendee->phone_number ?? '-' }}</p>
        <p><strong>Event:</strong> {{ $attendee->event->title ?? '-' }}</p>
        <p><strong>Date:</strong> {{ $attendee->event->date}}</p>
    </div>
</div>

<a href="{{ route('attendees.index') }}" class="btn btn-warning mt-3">Back to Attendees</a>
@endsection
