@extends('layouts.app')

@section('title', 'Event Details')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Event Details</h1>

    <div class="card">
        <div class="card-header bg-warning text-dark">
            {{ $event->title }}
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $event->description ?? 'N/A' }}</p>
            <p><strong>Department:</strong> {{ $event->department->name }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Organizer:</strong> {{ $event->organizer_name }}</p>
        </div>
    </div>

    <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">Back to Events</a>
</div>

@endsection
