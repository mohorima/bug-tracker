<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
        $projects = Project::latest()->paginate(25);

        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        $clients = Client::select('id', 'company')->get();
        return view('projects.create', compact('clients'));
    }

    public function store(ProjectRequest $request)
    {
        $this->createProject($request);
        return redirect('/project/create')->with(
            'message',
            'New Project Added!'
        );
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    public function update($id, ProjectRequest $request)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect('/project');
    }

    private function createProject(ProjectRequest $request)
    {
        $project = Project::create([
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

        return $project;
    }
}
