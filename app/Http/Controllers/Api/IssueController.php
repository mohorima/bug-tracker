<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchTerm = request('keywords');
        $orderTermAsc = request('orderTermAsc');
        $orderTermDesc = request('orderTermDesc');

        if (Auth::user()->role_id == Role::IS_ADMIN) {
            $issue = Issue::with(['project', 'assignee'])
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query
                        ->where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('severity', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
                })
                ->when($orderTermAsc, function ($query, $orderTermAsc) {
                    return $query->orderBy($orderTermAsc, 'ASC');
                })
                ->when($orderTermDesc, function ($query, $orderTermDesc) {
                    return $query->orderBy($orderTermDesc, 'desc');
                })
                ->latest()
                ->paginate(25);
        } else {
            $issue = Issue::where('user_id', auth()->id())
                ->orWhere('assignee_id', auth()->id())
                ->with(['project', 'assignee'])
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query
                        ->where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('severity', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
                })
                ->when($orderTermAsc, function ($query, $orderTermAsc) {
                    return $query->orderBy($orderTermAsc, 'ASC');
                })
                ->when($orderTermDesc, function ($query, $orderTermDesc) {
                    return $query->orderBy($orderTermDesc, 'desc');
                })
                ->latest()
                ->paginate(25);
        }

        return $issue;
    }

    public function assignee()
    {
        return User::whereNotIn('role_id', [Role::IS_ADMIN])
            ->latest()
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IssueRequest $request)
    {
        return Issue::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'severity' => $request->input('severity'),
            'dueDate' => $request->input('dueDate'),
            'status' => $request->input('status'),
            'user_id' => auth()->id(),
            'project_id' => $request->input('project_id'),
            'assignee_id' => $request->input('assignee_id'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IssueRequest $request, Issue $issue)
    {
        $this->authorize('update', $issue);
        $issue->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        $this->authorize('delete', $issue);
        $issue->delete();

        return ['msg' => 'Issue deleted'];
    }
}
