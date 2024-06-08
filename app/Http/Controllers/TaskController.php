<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->get();
        return view('task.list', compact('tasks'));
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        try {
            Task::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return redirect()->route('list')->with(['message' => 'Task created successfully..!']);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json($e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $task = Task::find($request->id);
        return view('task.edit', compact('task'));
    }

    public function update(Request $request)
    {
        try {
            $task = Task::find($request->eid);
            $task->update([
                'title' => $request->title ?? $task->title,
                'description' => $request->description ?? $task->description
            ]);
            return redirect()->route('list')->with(['message' => 'Task updated successfully..!']);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json($e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try{
            $task = Task::find($request->did);
            $task->delete();
            return redirect()->route('list')->with(['message' => 'Task deleted successfully..!']);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response()->json($e->getMessage());
        }
    }


    public function statusDone(Request $request){
        $status = Task::find(2);
        $status->update([
            'completed' => true
        ]);
        echo "Done";
    }

    public function statusPending(){
        $status = Task::find(2);
        $status->update([
            'completed' => false
        ]);
        echo "Pending";
    }
}
