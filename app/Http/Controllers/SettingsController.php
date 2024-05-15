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
    public function index(Request $request)
    {
        if (auth()->user()->is_admin == true) {
            $projects = Project::all();
            $projectDetail = Project::find($request->project);
        } else {
            $projects = Project::where('user_id', auth()->user()->id)->get();
            $projectDetail = Project::where('user_id', auth()->user()->id)->first();
        }
        return view('settings', compact('projects','projectDetail'));
    }


    public function store(Request $request, $id = null)
    {
        $request->validate([
            'file' => 'nullable|file|image',
            'splash' => 'nullable|file|image',
        ]);
        $status = empty($id) ? 'Created' : 'Updated';
        if (!empty($request->file)) {
            $logoPath = Helpers::fileUpload($request->file, 'images/project-logo');
        }
        if (!empty($request->splash)) {
            $splashPath = Helpers::fileUpload($request->splash, 'images/project-splash');
        }
        $project = Project::find($id);
        $project->updateOrCreate(
            ['id' => $id],
            [
                'logo' => $logoPath ?? $project->logo,
                'splash' => $splashPath ?? $project->splash,
                'head_color' => $request->head_color,
                'bg_color' => $request->bg_color,
                'splash_color' => $request->splash_color,
            ]
        );
        session()->flash('success', 'Project has been ' . $status . ' Successfully!');
        return back();
    }

    public function statistics(Request $request)
    {
        if (auth()->user()->is_admin == true) {
            $projects = Project::all();
            $project = Project::find($request->project);
            if (!empty($request->project)) {
                $visits = POIVisit::with('poi')->where('project_id', $project->id)->get()->groupBy('device');
                $computerVisits = POIVisit::where('project_id', $project->id)->where('device_type', 'Computer')->get()->groupBy('device')->count();
                $phoneVisits = POIVisit::where('project_id', $project->id)->where('device_type', 'Phone')->get()->groupBy('device')->count();
                $tabletVisits = POIVisit::where('project_id', $project->id)->where('device_type', 'Tablet')->get()->groupBy('device')->count();
                $totalDevices = POIVisit::where('project_id', $project->id)->get()->groupBy('device_type')->count();
                $short_codes = POIVisit::where('project_id', $project->id)->where('link_type', 'short_code')->get();
                $qrcodes = POIVisit::where('project_id', $project->id)->where('link_type', 'qrcode')->get();
                $histories = ProjectHistory::where('project_id', $project->id)->orderBy('created_at', 'desc')->get();
            }elseif (!empty($request->exhibition)) {
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
                $short_codes = POIVisit::whereHas('poi', function ($q) use ($request) {
                    $q->where('exhibition_id', $request->exhibition);
                })->where('link_type', 'short_code')->get();
                $qrcodes = POIVisit::whereHas('poi', function ($q) use ($request) {
                    $q->where('exhibition_id', $request->exhibition);
                })->where('link_type', 'qrcode')->get();
                $histories = ProjectHistory::where('project_id', $projectId->project_id)->orderBy('created_at','desc')->get();
            } else {
                $visits = POIVisit::with('poi')->get()->groupBy('device');
                $computerVisits = POIVisit::where('device_type', 'Computer')->get()->groupBy('device')->count();
                $phoneVisits = POIVisit::where('device_type', 'Phone')->get()->groupBy('device')->count();
                $tabletVisits = POIVisit::where('device_type', 'Tablet')->get()->groupBy('device')->count();
                $totalDevices = POIVisit::get()->groupBy('device_type')->count();
                $short_codes = POIVisit::where('link_type', 'short_code')->get();
                $qrcodes = POIVisit::where('link_type', 'qrcode')->get();
                $histories = ProjectHistory::orderBy('created_at', 'desc')->get();
            }
        }elseif (!empty($request->exhibition)) {
            $projects = Project::where('user_id', auth()->user()->id)->get();
            $project = Project::where('user_id', auth()->user()->id)->first();
            $projectId = Exhibition::whereHas('project',function($q){
                $q->where('user_id',auth()->user()->id);
            })->find($request->exhibition);

            $visits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition)
                ->whereHas('exhibition',function($e){
                    $e->whereHas('project',function($p){
                        $p->where('user_id',auth()->user()->id);
                    });
                });
            })->get()->groupBy('device');
            $computerVisits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition)
                ->whereHas('exhibition',function($e){
                    $e->whereHas('project',function($p){
                        $p->where('user_id',auth()->user()->id);
                    });
                });
            })->where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition)
                ->whereHas('exhibition',function($e){
                    $e->whereHas('project',function($p){
                        $p->where('user_id',auth()->user()->id);
                    });
                });
            })->where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition)
                ->whereHas('exhibition',function($e){
                    $e->whereHas('project',function($p){
                        $p->where('user_id',auth()->user()->id);
                    });
                });
            })->where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition)
                ->whereHas('exhibition',function($e){
                    $e->whereHas('project',function($p){
                        $p->where('user_id',auth()->user()->id);
                    });
                });
            })->get()->groupBy('device_type')->count();
            $short_codes = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition)
                ->whereHas('exhibition',function($e){
                    $e->whereHas('project',function($p){
                        $p->where('user_id',auth()->user()->id);
                    });
                });
            })->where('link_type', 'short_code')->get();
            $qrcodes = POIVisit::whereHas('poi', function ($q) use ($request) {
                $q->where('exhibition_id', $request->exhibition)
                ->whereHas('exhibition',function($e){
                    $e->whereHas('project',function($p){
                        $p->where('user_id',auth()->user()->id);
                    });
                });
            })->where('link_type', 'qrcode')->get();
            $histories = ProjectHistory::where('project_id', $projectId->project_id)->orderBy('created_at','desc')->get();
        } else {
            $projects = Project::where('user_id', auth()->user()->id)->get();
            $project = Project::where('user_id', auth()->user()->id)->first();
            $visits = POIVisit::with('poi')->where('project_id', $project->id)->get()->groupBy('device');
            $computerVisits = POIVisit::where('project_id', $project->id)->where('device_type', 'Computer')->get()->groupBy('device')->count();
            $phoneVisits = POIVisit::where('project_id', $project->id)->where('device_type', 'Phone')->get()->groupBy('device')->count();
            $tabletVisits = POIVisit::where('project_id', $project->id)->where('device_type', 'Tablet')->get()->groupBy('device')->count();
            $totalDevices = POIVisit::where('project_id', $project->id)->get()->groupBy('device_type')->count();
            $short_codes = POIVisit::where('project_id', $project->id)->where('link_type', 'short_code')->get();
            $qrcodes = POIVisit::where('project_id', $project->id)->where('link_type', 'qrcode')->get();
            $histories = ProjectHistory::where('project_id', $project->id)->orderBy('created_at', 'desc')->get();
        }
        return view('statistics', compact('projects', 'project', 'computerVisits', 'phoneVisits', 'tabletVisits', 'visits', 'totalDevices', 'histories', 'short_codes', 'qrcodes'));
    }
}
