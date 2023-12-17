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
        [$tasks, $count, $page] = Task::searchByQuery($request->search, $request->page);
        
        foreach ($tasks as $task) {
            $task->content = nl2br(htmlspecialchars($task->content));
        }

        return view('/task/index', [
            'search' => $request->search,
            'tasks' => $tasks,
            'page' => $page,
            'count' => $count,
            'max_page' => ceil($count / Task::MAX_PER_PAGE)
        ]);
    }

    public function edit (Request $request) 
    {
        $request->validate([
            'id' => self::VALIDATE_ID
        ]);

        $task = Task::where('id', $request->id)->first();

        return view('/task/edit', compact('task'));
    }

    public function create (Request $request) 
    {
        $request->validate([
            'title' => self::VALIDATE_TITLE,
            'content' => self::VALIDATE_CONTENT
        ]);

        Task::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect('/');
    }

    public function update (Request $request) 
    {
        $request->validate([
            'id' => self::VALIDATE_ID,
            'title' => self::VALIDATE_TITLE,
            'content' => self::VALIDATE_CONTENT
        ]);

        Task::where('id', $request->id)->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect('/');
    }

    public function delete (Request $request) 
    {
        $request->validate([
            'id' => self::VALIDATE_ID
        ]);

        Task::where('id', $request->id)->delete();

        return redirect('/');
    }
}
