<?php

namespace App\Http\Controllers;

use App\Models\Speaker;

use Illuminate\Http\Request;
class SpeakerController extends Controller {
    function create() {
        return view('speaker.form');
    }

    function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:speakers,email',
            'bio' => 'nullable|string'
        ]);

        Speaker::create($validated);
        return redirect('/')->with('success', 'Request submitted for approval.');
    }
}
