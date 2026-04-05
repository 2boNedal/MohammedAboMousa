@extends('cms.temp')

@section('title', 'Task Details')

@section('content')
<div class="container">
    <h1>{{ $task->title }}</h1>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>Status:</strong>
        @if($task->status == 'pending')
            <span class="badge badge-warning">Pending</span>
        @else
            <span class="badge badge-success">Completed</span>
        @endif
    </p>
    <p><strong>Category:</strong> {{ $task->category->name }}</p>
    <p><strong>Owner:</strong> {{ $task->user->name }}</p>
    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection