<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});


// Todo App Routes
Route::get('task/list', [TaskController::class, 'showAllTask'])->name('showAllTasks');
Route::post('task/create', [TaskController::class, 'storeTask'])->name('create');
