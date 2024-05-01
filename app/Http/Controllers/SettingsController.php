<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use App\Models\POI;
use App\Models\POIVisit;
use App\Models\Project;
use App\Models\ProjectHistory;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('settings', compact('projects'));
    }

    public function statistics(Request $request)
    {
        $projects = Project::all();
        if (!empty($request->project)) {
            $visits = POIVisit::with('poi')->where('project_id', $request->project)->get()->groupBy('device');
            $computerVisits = POIVisit::where('project_id', $request->project)->where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::where('project_id', $request->project)->where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::where('project_id', $request->project)->where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::where('project_id', $request->project)->get()->groupBy('device_type')->count();
            $histories = ProjectHistory::where('project_id',$request->project)->get();
        }elseif (!empty($request->exhibition)) {
            $projectId = Exhibition::find($request->exhibition);

            $visits = POIVisit::whereHas('poi', function($q) use ($request){
                $q->where('exhibition_id',$request->exhibition);
            })->get()->groupBy('device');
            $computerVisits = POIVisit::whereHas('poi', function($q) use ($request){
                $q->where('exhibition_id',$request->exhibition);
            })->where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::whereHas('poi', function($q) use ($request){
                $q->where('exhibition_id',$request->exhibition);
            })->where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::whereHas('poi', function($q) use ($request){
                $q->where('exhibition_id',$request->exhibition);
            })->where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::whereHas('poi', function($q) use ($request){
                $q->where('exhibition_id',$request->exhibition);
            })->get()->groupBy('device_type')->count();
            $histories = ProjectHistory::where('project_id',$projectId->project_id)->get();
        } else {
            $visits = POIVisit::with('poi')->get()->groupBy('device');
            $computerVisits = POIVisit::where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::get()->groupBy('device_type')->count();
            $histories = ProjectHistory::all();
        }
        return view('statistics', compact('projects', 'computerVisits', 'phoneVisits', 'tabletVisits', 'visits', 'totalDevices','histories'));
    }
}
