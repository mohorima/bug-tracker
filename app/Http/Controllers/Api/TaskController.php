<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Task::with('project')
            ->with('user')
            ->with('collaborator')
            ->latest()
            ->paginate(25);
    }

    public function store(TaskRequest $request)
    {
        return Task::create([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'status' => $request->input('status'),
            'startDate' => $request->input('startDate'),
            'endDate' => $request->input('endDate'),
            'user_id' => auth()->user()->id,
            'project_id' => $request->input('project_id'),
            'collaborator_id' => $request->input('collaborator_id'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update($request->all());
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return ['msg' => 'Task deleted'];
    }
}
