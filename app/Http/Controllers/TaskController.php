<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['category', 'user'])->get();
        return view('cms.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('cms.tasks.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Task::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Task created successfully',
        ]);
    }

    public function show($id)
    {
        $task = Task::with(['category', 'user'])->findOrFail($id);
        return view('cms.tasks.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $categories = Category::all();
        $users = User::all();

        return view('cms.tasks.edit', compact('task', 'categories', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Task moved to trash',
        ]);
    }

    public function trashed()
    {
        $tasks = Task::onlyTrashed()->with(['category', 'user'])->get();
        return view('cms.tasks.trashed', compact('tasks'));
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->restore();

        return response()->json([
            'status' => 'success',
            'message' => 'Task restored successfully',
        ]);
    }

    public function forceDelete($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);
        $task->forceDelete();

        return response()->json([
            'status' => 'success',
            'message' => 'Task permanently deleted',
        ]);
    }
}