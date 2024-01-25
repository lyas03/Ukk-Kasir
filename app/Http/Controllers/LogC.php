<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use Illuminate\Http\Request;

class LogC extends Controller
{
    public function log ()
    {
        $logs = LogM::all();

        
        return view('content.log', compact('logs'));
    }
}
