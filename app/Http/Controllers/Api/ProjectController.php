<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $searchTerm = request('keywords');

        return Project::with('client')
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query
                    ->where('title', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
            })
            ->latest()
            ->paginate();
    }

    public function store(ProjectRequest $request)
    {
        //create project & get id of the created project
        //find the current logged in user
        //add record (user_id & project_id) in project_user pivot table

        $user = User::findOrFail(auth()->user()->id);
        return $user
            ->projects()
            ->sync(Project::create($request->all())->id, false);
    }

    public function show($id)
    {
        //
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return ['msg' => 'Project deleted'];
    }

    public function member()
    {
        $searchTerm = request('keywords');

        return User::with('role')
            ->where('id', '!=', auth()->id())
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query
                    ->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('email', 'LIKE', '%' . $searchTerm . '%');
            })
            ->latest()
            ->paginate(25);
    }

    public function storeMember()
    {
        //get project_id and all selected user_id from project_user array

        $project = Project::findOrFail(request('id'));
        $project->users()->sync(request('project_user'));

        //$project->users()->sync(request('project_user'), false);
    }
}
