<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Notes\StoreRequest;
use App\Http\Requests\API\Notes\UpdateRequest;
use App\Guest;
use App\Note;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = filterTokenValue($request->cookie('token', ''));

        return response()->json([
            'notes' => Note::byGuestToken($token)
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\API\Notes\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $token = filterTokenValue($request->cookie('token', ''));
        $guest = Guest::byToken($token)->first();

        $note = Note::create([
            'content' => $request->input('content'),
            'guest_id' => $guest->id,
            'style' => $request->input('style'),
            'title' => $request->input('title'),
        ]);

        return response()->json([
            'note' => $note,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token = filterTokenValue($request->cookie('token', ''));
        $note = Note::whereId($id)->byGuestToken($token)->first();

        if (!$note) {
            return response()->json([
                'errors' => [],
                'message' => 'Note not found',
            ], 404);
        }

        return response()->json([
            'note' => $note,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\API\Notes\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $token = filterTokenValue($request->cookie('token', ''));
        $note = Note::whereId($id)->byGuestToken($token)->first();

        if (!$note) {
            return response()->json([
                'errors' => [],
                'message' => 'Note not found',
            ], 404);
        }

        $note->content = $request->input('content');
        $note->style = $request->input('style');
        $note->title = $request->input('title');
        $note->save();

        return response()->json([
            'note' => $note,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $token = filterTokenValue($request->cookie('token', ''));
        $note = Note::whereId($id)->byGuestToken($token)->first();

        if (!$note) {
            return response()->json([
                'errors' => [],
                'message' => 'Note not found',
            ], 404);
        }

        $note->delete();

        return response()->json([]);
    }
}
