<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::orderBy('id', 'desc')->get();
        return view('task.list', compact('tasks'));
    }

    public function create(){
        return view('task.create');
    }

    public function store(Request $request){
        dd($request->all);
    }

    public function edit(Request $request){

    }

    public function update(Request $request){

    }

    public function destroy(Request $request){

    }
}
