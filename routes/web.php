<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});


// Todo App Routes
Route::get('all/tasks', [TaskController::class, 'index'])->name('list');
Route::get('create/task', [TaskController::class, 'create'])->name('create');
Route::post('store/task', [TaskController::class, 'store'])->name('store');
Route::get('edit/task', [TaskController::class, 'edit'])->name('edit');
Route::put('update/task', [TaskController::class, 'update'])->name('update');
Route::delete('delete/task', [TaskController::class, 'destroy'])->name('delete');
