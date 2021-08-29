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

        //$clients = Client::select('id', 'company')->get();
    }

    public function store(ProjectRequest $request)
    {
        //create project & get id of the created project
        //find the current logged in user
        //add record (user_id & project_id) in project_user pivot table

        $user = User::findOrFail(auth()->user()->id);
        return $user->projects()->sync(
            Project::create([
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
            ])->id,
            false
        );
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
