<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
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
        $notes = Note::latest()->paginate(25);

        return view('notes.index', compact('notes'));
    }

    public function show($id)
    {
        $note = Note::findOrFail($id);

        return view('notes.show', compact('note'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(NoteRequest $request)
    {
        $this->createNote($request);
        return redirect('/note/create')->with('message', 'New Note Added!');
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);

        return view('notes.edit', compact('note'));
    }

    public function update($id, NoteRequest $request)
    {
        $note = Note::findOrFail($id);
        $note->update($request->all());

        return redirect()->back();
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect('/note');
    }

    private function createNote(NoteRequest $request)
    {
        $note = Note::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'tag' => $request->input('tag'),
            'user_id' => $request->input('user_id'),
        ]);

        return $note;
    }
}
