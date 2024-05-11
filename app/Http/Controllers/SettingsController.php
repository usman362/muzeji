<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Exhibition;
use App\Models\POI;
use App\Models\POIDetail;
use App\Models\POIMedia;
use App\Models\POIVisit;
use App\Models\Project;
use App\Models\ProjectHistory;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        if(auth()->user()->is_admin == true){
            $projects = Project::all();
        }else{
            $projects = Project::where('user_id',auth()->user()->id)->get();
        }
        return view('settings', compact('projects'));
    }


    public function store(Request $request,$id = null)
    {
        $request->validate([
            'file' => 'required|file|image',
            'title' => 'required',
            'description' => 'required',
        ]);
        $status = empty($id) ? 'Created' : 'Updated';
        $logoPath = Helpers::fileUpload($request->file, 'images/project-logo');
        $splashPath = Helpers::fileUpload($request->file, 'images/project-splash');

        $project = Project::updateOrCreate(
            ['id' => $id],
            [
                'logo' => $logoPath,
                'splash' => $splashPath,
                'title' => $request->title,
                'description' => $request->description,
                'head_color' => $request->head_color,
                'bg_color' => $request->bg_color,
                'splash_color' => $request->splash_color,
                'user_id' => auth()->user()->id
            ]
        );
        session()->flash('success', 'Project has been ' . $status . ' Successfully!');
        return back();
    }

    public function statistics(Request $request)
    {
        if(auth()->user()->is_admin == true){
            $projects = Project::all();
        }else{
            $projects = Project::where('user_id',auth()->user()->id)->get();
        }
        if (!empty($request->project)) {
            $visits = POIVisit::with('poi')->where('project_id', $request->project)->get()->groupBy('device');
            $computerVisits = POIVisit::where('project_id', $request->project)->where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::where('project_id', $request->project)->where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::where('project_id', $request->project)->where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::where('project_id', $request->project)->get()->groupBy('device_type')->count();
            $short_codes = POIVisit::where('project_id', $request->project)->where('link_type','short_code')->get();
            $qrcodes = POIVisit::where('project_id', $request->project)->where('link_type','qrcode')->get();
            $histories = ProjectHistory::where('project_id', $request->project)->get();
        } elseif (!empty($request->exhibition)) {
            $projectId = Exhibition::find($request->exhibition);

            $visits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition);
            })->get()->groupBy('device');
            $computerVisits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition);
            })->where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition);
            })->where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition);
            })->where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition);
            })->get()->groupBy('device_type')->count();
            $histories = ProjectHistory::where('project_id', $projectId->project_id)->get();
        } else {
            $visits = POIVisit::with('poi')->get()->groupBy('device');
            $computerVisits = POIVisit::where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::get()->groupBy('device_type')->count();
            $histories = ProjectHistory::all();
        }
        return view('statistics', compact('projects', 'computerVisits', 'phoneVisits', 'tabletVisits', 'visits', 'totalDevices', 'histories','short_codes','qrcodes'));
    }
}
