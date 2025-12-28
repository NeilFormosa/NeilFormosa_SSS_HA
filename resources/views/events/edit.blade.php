@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')

<h1 class="mb-3">Edit Event</h1>

{{-- Validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Title --}}
    <div class="mb-3">
        <label class="form-label">Event Title</label>
        <input
            type="text"
            name="title"
            class="form-control"
            value="{{ old('title', $event->title) }}"
            required
        >
    </div>

    {{-- Description --}}
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea
            name="description"
            class="form-control"
            rows="3"
        >{{ old('description', $event->description) }}</textarea>
    </div>

    {{-- Department --}}
    <div class="mb-3">
        <label class="form-label">Department</label>
        <select name="department_id" class="form-select" required>
            @foreach ($departments as $department)
                <option
                    value="{{ $department->id }}"
                    {{ $event->department_id == $department->id ? 'selected' : '' }}
                >
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Date --}}
    <div class="mb-3">
        <label class="form-label">Event Date</label>
        <input
            type="date"
            name="date"
            class="form-control"
            value="{{ old('date', $event->date) }}"
            required
        >
    </div>

    {{-- Location --}}
    <div class="mb-3">
        <label class="form-label">Location</label>
        <input
            type="text"
            name="location"
            class="form-control"
            value="{{ old('location', $event->location) }}"
            required
        >
    </div>

    {{-- Organizer --}}
    <div class="mb-3">
        <label class="form-label">Organizer Name</label>
        <input
            type="text"
            name="organizer_name"
            class="form-control"
            value="{{ old('organizer_name', $event->organizer_name) }}"
            required
        >
    </div>

    <button class="btn btn-warning">Update Event</button>
    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection
