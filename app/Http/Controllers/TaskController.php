<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::latest()->paginate(25);

        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(TaskRequest $request)
    {
        $this->createTask($request);
        return redirect('/task/create')->with('message', 'New Task Added!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    public function update($id, TaskRequest $request)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/task');
    }

    private function createTask(TaskRequest $request)
    {
        $task = Task::create([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'status' => $request->input('status'),
            'tag' => $request->input('tag'),
            'milestone' => $request->input('milestone'),
            'startDate' => $request->input('startDate'),
            'endDate' => $request->input('endDate'),
            'user_id' => $request->input('user_id'),
            'project_id' => $request->input('project_id'),
            'collaborator_id' => $request->input('collaborator_id'),
        ]);

        return $task;
    }
}
