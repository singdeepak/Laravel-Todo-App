<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TaskController;


// Todo App Routes
Route::get('/', [TaskController::class, 'index'])->name('list');
Route::get('create/task', [TaskController::class, 'create'])->name('create');
Route::post('store/task', [TaskController::class, 'store'])->name('store');
Route::get('edit/task', [TaskController::class, 'edit'])->name('edit');
Route::put('update/task', [TaskController::class, 'update'])->name('update');
Route::delete('delete/task', [TaskController::class, 'destroy'])->name('delete');

Route::post('change/task/done', [TaskController::class, 'statusDone'])->name('task-status-done');
Route::post('change/status/pending', [TaskController::class, 'statusPending'])->name('task-status-pending');
