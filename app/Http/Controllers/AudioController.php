<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $filename = time() . '-' . $audio->getClientOriginalName();
            $path = $audio->storeAs('public/audios/poi-audios', $filename);
            return response()->json(['success' => true, 'path' => $path]);
        }

        return response()->json(['success' => false, 'message' => 'No audio file uploaded.']);
    }
}
