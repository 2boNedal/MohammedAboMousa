@extends('cms.temp')

@section('title', 'Tasks')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Tasks</h1>
        <div>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
            <a href="{{ route('tasks.trashed') }}" class="btn btn-secondary">View Deleted</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Category</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>
                    @if($task->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @else
                        <span class="badge badge-success">Completed</span>
                    @endif
                </td>
                <td>{{ $task->category->name }}</td>
                <td>{{ $task->user->name }}</td>
                <td>
                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">Show</a>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="destroy('{{ route('tasks.destroy', $task->id) }}')">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('tasks.trashed') }}" class="btn btn-secondary">View Deleted</a>
</div>
@endsection