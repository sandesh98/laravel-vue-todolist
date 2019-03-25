<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = auth()->user()
            ->tasks()
            ->latest()
            ->get();

        return $tasks;
    }

    public function store(Request $request)
    {
        $task = auth()->user()
            ->tasks()
            ->create($request->all());

        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->only('text'));

        if ($request->has('done')) {
            $task->done = !$task->done;
            $task->save();
        }

        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return;
    }

}
