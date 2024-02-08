<?php

namespace App\Http\Controllers;

use App\Models\LogM;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LogC extends Controller
{
    public function log ()
    {
        $logs = LogM::all();

        return view('Log.log', compact('logs'));
    }
    public function search(Request $request)
    {
        // Validate the input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
        $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

        // Query to filter logs based on the date range
        $logs = LogM::whereBetween('created_at', [$start_date, $end_date])->get();

        return view('Log.log', ['logs' => $logs]);
    }
}
