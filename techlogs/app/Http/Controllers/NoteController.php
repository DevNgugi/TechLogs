<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    //
    public function index()
    {
        $notifications = Note::query()
            ->where('to', Auth::User()->email)
       
            ->get();
        return view('notifications', ['notifications' => $notifications]);
    }

    public function viewNotes($id)
    {
        $notes = Note::query()
            ->where('to', $id)
            ->where('is_read', 0)
            ->orderBy('created_at','DESC')
            ->get();

            foreach ($notes as $value) {
               
                $date=Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->diffForHumans();
                $value->date=$date;
                
            }
       
        return response($notes);
    }

    public function singleNote($id)
    {
      
        $note = Note::findOrFail($id);
        $note->is_read='1';
        if($note->save()){
            $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $note->created_at)->diffForHumans();

            return response()->json(['note' => $note, 'created_at' => $created_at]);
        }

        return response(false);

    }
}
