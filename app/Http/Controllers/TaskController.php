<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    const VALIDATE_ID = 'required|exists:tasks,id';
    const VALIDATE_TITLE = 'required|max:64';
    const VALIDATE_CONTENT = 'required|max:256';

    public function index (Request $request) 
    {
        $tasks = Task::all();

        // 検索機能の実装
        if (isset($request->search)) {
            $cond = implode(' AND ', array_map(function($search){
                return '(title LIKE ? OR content LIKE ?)';
            }, explode(' ', $request->search)));

            $searchs = [];
            foreach (explode(' ', $request->search) as $search) {
                $search = '%' . addcslashes($search, '%_\\') . '%';
                array_push($searchs, $search, $search);
            }

            $tasks = Task::whereRaw($cond, $searchs)->get();
        }
        
        foreach ($tasks as $task) {
            $task->content = nl2br(htmlspecialchars($task->content));
        }

        return view('task/index', compact('tasks'));
    }

    public function edit (Request $request) 
    {
        $validated = $request->validate([
            'id' => self::VALIDATE_ID
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
            'title' => self::VALIDATE_TITLE,
            'content' => self::VALIDATE_CONTENT
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
            'id' => self::VALIDATE_ID,
            'title' => self::VALIDATE_TITLE,
            'content' => self::VALIDATE_CONTENT
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
            'id' => self::VALIDATE_ID
        ]);

        if ($validated) {
            Task::where('id', $request->id)->delete();
        }

        return redirect('/');
    }
}
