<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::orderBy('id','desc')->get();
    }

    public function store(Request $request)
    {
        return Task::create($request->all());
    }

    public function show($id)
    {
        $task = Task::find($id);
        if(!$task) {
            return response('A task not found', 404);
        }
        return $task;
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if(!$task) {
            return response('A task not found', 404);
        }
        $task->update($request->all());
        return $task;
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if(!$task) {
            return response('A task not found', 404);
        }
        $task->delete();
        // return $task;
        return response()->json([
            'task' => $task,
            'msg' => 'A post was deleted.'
        ]);
        
    }
}
