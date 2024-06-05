<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function showAllTask(){
        $tasks = Task::orderBy('id', 'desc')->get();
        return view('list', compact('tasks'));
    }


    public function createTask(){
        return view('list');
    }

    public function storeTask(Request $request){
        Task::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return 1;
    }
}
