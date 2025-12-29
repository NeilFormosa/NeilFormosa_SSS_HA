@extends('layouts.app')

@section('title', 'Events')

@section('content')

<h1 class="mb-3 text-warning">Events</h1>

<a href="{{ route('events.create') }}" class="btn btn-warning mb-3">
    Create Event
</a>

<div class="mb-3">
    <a href="{{ route('events.index') }}" class="btn btn-secondary">
        Default Order
    </a>

    <a href="{{ route('events.index', ['sort' => 'department']) }}" class="btn btn-warning">
        Sort by Department
    </a>
</div>


<table class="table table-bordered">
    <thead class="table-warning">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Department</th>
            <th>Date</th>
            <th width="220">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->department->name }}</td>
                <td>{{ $event->date }}</td>
                <td>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-info">
                        View
                    </a>

                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('events.destroy', $event->id) }}"
                          method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
