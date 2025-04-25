<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speaker;

class HomeController extends Controller
{
    //
    function index() {
        $speakers = Speaker::where('status', 'approved')
            ->whereNotNull('schedule_time')
            ->orderBy('schedule_time')
            ->get();
        return view('calendar.index', compact('speakers'));
    }
    
}
