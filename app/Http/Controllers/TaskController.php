<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index () 
    {
        $tasks = Task::all();

        return view('task/index', compact('tasks'));
    }

    public function edit (Request $request) 
    {
        $id = $request->input('id');

        if (isset($id)) {
            $tasks = Task::where('id', $id);
            if ($tasks->count()) {
                $task = $tasks->first();
                return view('task/edit', compact('task'));
            }
        }

        return redirect('/');
    }

    public function create (Request $request) 
    {
        $title = $request->input('title');
        $content = $request->input('content');

        if (isset($title, $content)) {
            Task::create([
                'title' => $title,
                'content' => $content
            ]);
        }

        return redirect('/');
    }

    public function update (Request $request) 
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');

        if (isset($id, $title, $content)) {
            $task = Task::where('id', $id);
            if ($task->count()) {
                Task::where('id', $id)->update([
                    'title' => $title,
                    'content' => $content
                ]);
            }
        }

        return redirect('/');
    }

    public function delete (Request $request) 
    {
        $id = $request->input('id');

        if (isset($id)) {
            $task = Task::where('id', $id);
            if ($task->count()) {
                Task::where('id', $id)->delete();
            }
        }

        return redirect('/');
    }
}
