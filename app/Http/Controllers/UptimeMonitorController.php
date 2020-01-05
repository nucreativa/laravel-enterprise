<?php

namespace App\Http\Controllers;

use Spatie\UptimeMonitor\Models\Monitor;

class UptimeMonitorController extends Controller
{
    public function index()
    {
        $sites = Monitor::all();

        return view('uptime', compact('sites'));
    }
}
