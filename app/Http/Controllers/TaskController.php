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
        $validated = $request->validate([
            'id' => 'required|exists:tasks,id'
        ]);

        if ($validated) {
            $task = Task::where('id', $request->id)->first();
            return view('task/edit', compact('task'));
        }

        return redirect('/');
    }

    public function create (Request $request) 
    {
        $validated = $request->validate([
            'title' => 'required|max:64',
            'content' => 'required|max:256'
        ]);

        if ($validated) {
            Task::create([
                'title' => $request->title,
                'content' => $request->content
            ]);
        }

        return redirect('/');
    }

    public function update (Request $request) 
    {
        $validated = $request->validate([
            'id' => 'required|exists:tasks,id',
            'title' => 'required|max:64',
            'content' => 'required|max:256'
        ]);

        if ($validated) {
            Task::where('id', $request->id)->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
        }

        return redirect('/');
    }

    public function delete (Request $request) 
    {
        $validated = $request->validate([
            'id' => 'required|exists:tasks,id'
        ]);

        if ($validated) {
            Task::where('id', $request->id)->delete();
        }

        return redirect('/');
    }
}
