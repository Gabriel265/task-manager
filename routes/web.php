<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::resource('projects', ProjectController::class);
Route::resource('tasks', TaskController::class);

Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');

// Root
Route::get('/', function () {
    return redirect()->route('projects.index');
});