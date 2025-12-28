@extends('layouts.app')

@section('title', 'Register Attendee')

@section('content')
<h1 class="mb-3">Register Attendee</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('attendees.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
    </div>

    <div class="mb-3">
        <label for="event_id" class="form-label">Select Event</label>
        <select class="form-select" id="event_id" name="event_id" required>
            <option value="">-- Choose an Event --</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                    {{ $event->title }} ({{ $event->date }})
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-warning">Register</button>
</form>
@endsection
