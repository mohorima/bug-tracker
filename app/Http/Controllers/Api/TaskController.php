<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Role;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $searchTerm = request('keywords');

        if (Auth::user()->role_id == Role::IS_ADMIN) {
            $task = Task::with(['project', 'user', 'collaborator'])
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query
                        ->where('subject', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('priority', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
                })
                ->latest()
                ->paginate(25);
        } else {
            $task = Task::where('user_id', auth()->id())
                ->orWhere('collaborator_id', auth()->id())
                ->with(['project', 'user', 'collaborator'])
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query
                        ->where('subject', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('priority', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
                })
                ->latest()
                ->paginate(25);
        }

        return $task;
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
            'user_id' => auth()->id(),
            'project_id' => $request->input('project_id'),
            'collaborator_id' => $request->input('collaborator_id'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->all());
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return ['msg' => 'Task deleted'];
    }
}
