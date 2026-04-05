@extends('cms.temp')

@section('title', 'Trashed Tasks')

@section('content')
<div class="container">
    <h1>Deleted Tasks</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Category</th>
                <th>Owner</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>
                    @if($task->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @else
                        <span class="badge badge-success">Completed</span>
                    @endif
                </td>
                <td>{{ $task->category->name }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->deleted_at->format('Y-m-d H:i') }}</td>
                <td>
                    <button class="btn btn-success" onclick="restoreTask('{{ route('tasks.restore', $task->id) }}')">Restore</button>
                    <button class="btn btn-danger" onclick="destroy('{{ route('tasks.force-delete', $task->id) }}')">Force Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
</div>
@endsection

@section('scripts')
<script>
    function restoreTask(url) {
        axios.patch(url)
            .then(function (response) {
                showSuccessMessage(response.data.message ?? 'Restored successfully');
                location.reload();
            })
            .catch(function (error) {
                showErrorMessage(error.response?.data?.message ?? 'Restore failed');
            });
    }
</script>
@endsection