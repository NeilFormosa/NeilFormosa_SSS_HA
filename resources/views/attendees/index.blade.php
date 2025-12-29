@extends('layouts.app')

@section('title', 'Attendees')

@section('content')
<h1 class="mb-3">Attendees</h1>

<a href="{{ route('attendees.create') }}" class="btn btn-warning mb-3">
    Register Attendee
</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="mb-3">
    <a href="{{ route('attendees.index', ['sort' => 'name']) }}" class="btn btn-warning">
        Sort by Name
    </a>

    <a href="{{ route('attendees.index') }}" class="btn btn-secondary">
        Reset
    </a>
</div>

<table class="table table-bordered">
    <thead class="table-warning">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Event</th>
            <th width="200">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendees as $attendee)
            <tr>
                <td>{{ $attendee->id }}</td>
                <td>{{ $attendee->name }}</td>
                <td>{{ $attendee->email }}</td>
                <td>{{ $attendee->phone_number }}</td>
                <td>{{ $attendee->event->title ?? '-' }}</td>
                <td>
                    <a href="{{ route('attendees.edit', $attendee->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('attendees.destroy', $attendee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>

                    <a href="{{ route('attendees.show', $attendee->id) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
