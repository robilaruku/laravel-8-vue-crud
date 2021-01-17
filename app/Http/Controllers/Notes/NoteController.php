<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Subject;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->get();
        return NoteResource::collection($notes);
    }

    public function show(Note $note)
    {
        return NoteResource::make($note);
    }

    public function store()
    {
        sleep(1);

        request()->validate([
            'subject' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $subject = Subject::findOrFail(request('subject'));

        $note = $subject->notes()->create([
            'subject_id' => $subject->id,
            'title' => request('title'),
            'slug' => \Str::slug(request('title')),
            'description' => request('description')
        ]);

        return response()->json([
            'message' => 'Youre note was created',
            'note' => $note,
        ]);
    }


    function update(Note $note)
    {

        sleep(1);
        
        request()->validate([
            'subject' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $subject = Subject::findOrFail(request('subject'));

        $note->update([
            'subject_id' => $subject->id,
            'title' => request('title'),
            'description' => request('description')
        ]);

        return response()->json([
            'message' => 'Youre note was updated',
            'note' => $note,
        ]);
    }

    public function destroy(Note $note)
    {
         $note->delete();

         return response()->json([
            'message' => 'Youre note was deleted'
         ], 200);
    }
}
