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
}
