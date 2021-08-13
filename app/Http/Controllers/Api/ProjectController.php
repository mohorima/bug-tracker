<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return Project::with('client')
            ->latest()
            ->paginate(25);
    }

    public function store(ProjectRequest $request)
    {
        return Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'startDate' => $request->input('startDate'),
            'endDate' => $request->input('endDate'),
            'billingType' => $request->input('billingType'),
            'cost' => $request->input('cost'),
            'estHours' => $request->input('estHours'),
            'tag' => $request->input('tag'),
            'status' => $request->input('status'),
            'client_id' => $request->input('client_id'),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return ['msg' => 'Project deleted'];
    }
}
