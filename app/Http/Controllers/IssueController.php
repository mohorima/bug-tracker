<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
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
        $issues = Issue::latest()->paginate(25);

        return view('issues.index', compact('issues'));
    }

    public function show($id)
    {
        $issue = Issue::findOrFail($id);

        return view('issues.show', compact('issue'));
    }

    public function create()
    {
        return view('issues.create');
    }

    public function store(IssueRequest $request)
    {
        $this->createIssue($request);
        return redirect('/issue/create')->with('message', 'New Issue Added!');
    }

    public function edit($id)
    {
        $issue = Issue::findOrFail($id);

        return view('issues.edit', compact('issue'));
    }

    public function update($id, IssueRequest $request)
    {
        $issue = Issue::findOrFail($id);
        $issue->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);
        $issue->delete();

        return redirect('/issue');
    }

    private function createIssue(IssueRequest $request)
    {
        $issue = Issue::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'severity' => $request->input('severity'),
            'flag' => $request->input('flag'),
            'dueDate' => $request->input('dueDate'),
            'status' => $request->input('status'),
            'tag' => $request->input('tag'),
            'user_id' => $request->input('user_id'),
            'project_id' => $request->input('project_id'),
            'assignee_id' => $request->input('assignee_id'),
        ]);

        return $issue;
    }
}
