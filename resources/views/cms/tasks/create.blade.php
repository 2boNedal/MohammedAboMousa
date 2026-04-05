@extends('cms.temp')

@section('title', 'Create Task')

@section('content')
<div class="container">
    <h1>Create Task</h1>

    <form id="taskForm">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Choose category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Owner</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Choose owner</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('taskForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const data = {
            _token: document.querySelector('input[name="_token"]').value,
            title: document.getElementById('title').value,
            description: document.getElementById('description').value,
            status: document.getElementById('status').value,
            category_id: document.getElementById('category_id').value,
            user_id: document.getElementById('user_id').value,
        };

        store('{{ route('tasks.store') }}', data);
    });
</script>
@endsection