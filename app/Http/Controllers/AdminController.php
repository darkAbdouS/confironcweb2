<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speaker;

class AdminController extends Controller {
    function index() {
        $requests = Speaker::where('status', 'pending')->get();
        return view('admin.requests', compact('requests'));
    }

    function approve($id) {
        $speaker = Speaker::findOrFail($id);
        $speaker->status = 'approved';
        $speaker->save();

        // Here you could trigger an email or other logic

        return back()->with('success', 'Speaker approved.');
    }

    function scheduleForm($id) {
        $speaker = Speaker::findOrFail($id);
        return view('admin.schedule', compact('speaker'));
    }
    
    function setSchedule(Request $request, $id) {
        $request->validate(['schedule_time' => 'required|date']);
        $speaker = Speaker::findOrFail($id);
        $speaker->schedule_time = $request->schedule_time;
        $speaker->save();
        return redirect('/admin/requests')->with('success', 'Scheduled!');
    }
    
}
