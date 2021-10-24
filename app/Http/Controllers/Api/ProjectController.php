<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        //$this->authorize('viewAny', Project::class);

        $searchTerm = request('keywords');

        if (
            in_array(Auth::user()->role_id, [Role::IS_ADMIN, Role::IS_MANAGER])
        ) {
            $project = Project::with('client')
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query
                        ->where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
                })
                ->latest()
                ->paginate();
        } else {
            $project = Project::assigneduser()
                ->with('client')
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query
                        ->where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
                })
                ->latest()
                ->paginate();
        }

        return $project;
    }

    public function store(ProjectRequest $request)
    {
        //create project & get id of the created project
        //find the current logged in user
        //add record (user_id & project_id) in project_user pivot table

        $this->authorize('create', Project::class);

        $user = User::findOrFail(auth()->id());
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
        $this->authorize('update', $project);
        $project->update($request->all());
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();

        return ['msg' => 'Project deleted'];
    }

    public function assignedMember($id)
    {
        $this->authorize('create', Project::class);
        return Project::with('users')->findOrFail($id);
    }

    public function member()
    {
        $this->authorize('create', Project::class);

        $searchTerm = request('keywords');

        return User::where('id', '!=', auth()->id())
            ->whereNotIn('role_id', [Role::IS_ADMIN, Role::IS_MANAGER])
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

        $this->authorize('create', Project::class);

        $project = Project::findOrFail(request('id'));
        $project->users()->sync(request('project_user'));
    }
}
