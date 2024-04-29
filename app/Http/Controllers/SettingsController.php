<?php

namespace App\Http\Controllers;

use App\Models\POIVisit;
use App\Models\Project;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('settings',compact('projects'));
    }

    public function statistics()
    {
        $projects = Project::all();
        $computerVisits = POIVisit::where('project_id',1)->where('device_type','Computer')->get();
        $phoneVisits = POIVisit::where('project_id',1)->where('device_type','Phone')->get();
        $tabletVisits = POIVisit::where('project_id',1)->where('device_type','Tablet')->get();
        return view('statistics',compact('projects','computerVisits','phoneVisits','tabletVisits'));
    }
}
