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
        $projects = Project::all();
        return view('settings', compact('projects'));
    }


    public function store(Request $request,$id = null)
    {
        $exhibitionIds = Exhibition::where('project_id',$id)->pluck('id');
        $poi = POI::with('exhibition:id,project_id')->whereIn('exhibition_id',$exhibitionIds)->get();
        foreach ($request->main_id as $key => $mainId) {
            $detail = POIDetail::updateOrCreate(['id' => $mainId], [
                'poi_id' => $id,
                'title' => $request->title[$key],
                'description' => $request->description[$key],
                'language' => $request->language[$key],
                'flag' => $request->flag[$key],
            ]);

            if (!empty(request('logo' . $key))) {
                POIMedia::where('detail_id', $detail->id)->where('type', 'logo')->delete();
                foreach (request('logo' . $key) as $key => $logo) {
                    $logoPath = Helpers::fileUpload($logo, 'images/poi-logo');
                    POIMedia::create([
                        'poi_id' => $id,
                        'detail_id' => $detail->id,
                        'type' => 'logo',
                        'media_url' => $logoPath,
                    ]);
                }
            }

            if (!empty(request('audio' . $key))) {
                POIMedia::where('detail_id', $detail->id)->where('type', 'audio')->delete();
                foreach (request('audio' . $key) as $key => $audio) {
                    $audioPath = Helpers::fileUpload($audio, 'images/poi-audios');
                    POIMedia::create([
                        'poi_id' => $id,
                        'detail_id' => $detail->id,
                        'type' => 'audio',
                        'media_url' => $audioPath,
                    ]);
                }
            }

            if (isset($request->video[$key])) {
                POIMedia::where('detail_id', $detail->id)->where('type', 'video')->delete();
                $videoPath = Helpers::fileUpload($request->video[$key], 'images/poi-videos');
                POIMedia::create([
                    'poi_id' => $id,
                    'detail_id' => $detail->id,
                    'type' => 'video',
                    'media_url' => $videoPath,
                ]);
            }

            if (isset($request->object[$key])) {
                POIMedia::where('detail_id', $detail->id)->where('type', 'object')->delete();
                $objectPath = Helpers::fileUpload($request->object[$key], 'images/poi-objects');
                POIMedia::create([
                    'poi_id' => $id,
                    'detail_id' => $detail->id,
                    'type' => 'object',
                    'media_url' => $objectPath,
                ]);
            }
        }
        return back();
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
        return view('statistics', compact('projects', 'computerVisits', 'phoneVisits', 'tabletVisits', 'visits', 'totalDevices', 'histories'));
    }
}
