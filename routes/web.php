<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->group(function () {
    Route::view('/', 'cms.temp')->name('cms.home');

    Route::get('tasks/trashed', [\App\Http\Controllers\TaskController::class, 'trashed'])->name('tasks.trashed');
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::patch('tasks/{task}/restore', [\App\Http\Controllers\TaskController::class, 'restore'])->name('tasks.restore');
    Route::delete('tasks/{task}/force-delete', [\App\Http\Controllers\TaskController::class, 'forceDelete'])->name('tasks.force-delete');
});