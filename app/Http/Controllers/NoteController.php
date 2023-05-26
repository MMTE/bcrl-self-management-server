<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return $this->handleResponse($notes, 'list of users notes.');
    }

    public function store(Request $request)
    {

        $id = $request->get('id');
        $text = $request->get('text');

        $note = Note::find($id);


        if (!$note) {
            $note = new Note();
            $note->user_id = Auth::id();
        }

        if (empty($text)) {
            $text = '';
        }

        $note->text = $text;
        $note->save();

        return $this->handleResponse(null, 'note saved successfully.');
    }

    public function delete(Request $request)
    {
        $note_id = $request->get('note_id');
        $note = Note::find($note_id);
        $note->delete();

        return $this->handleResponse(null, 'note deleted successfully');
    }

}
