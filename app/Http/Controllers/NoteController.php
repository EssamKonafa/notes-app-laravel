<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $notes = Note::where('user_id',auth()->id())->get();
        $notes = Note::whereUserId(auth()->id())->latest()->paginate(5);
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'create note';
        return view('notes.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'title' => 'required|string|min:5|max:255|unique:notes',
            'body' => 'required|string|min:10'
        ]);
        $request->user()->notes()->create($validate);
        dd('created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // dd($note);
        $title = 'show note';
        return view('notes.show', compact(['note', 'title']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        // $this->authorize('update', $note);
        $title = 'edit note';
        return view('notes.edit', compact(['note', 'title']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // $this->authorize('update', $note);
        // $validate = $request->validate([
        //     'title' => ['required', 'string', 'min:5', 'max:255', 'unique:notes', Rule::unique('notes')->ignore($note->id)],
        //     'body' => 'required|string|min:10'
        // ]);
        // $note->update($validate);
        // return view('notes.index', );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        // $this->auth
    }
}
