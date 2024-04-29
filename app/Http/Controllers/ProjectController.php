<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Exhibition;
use App\Models\POI;
use App\Models\POIDetail;
use App\Models\POIVisit;
use App\Models\Project;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ProjectController extends Controller
{
    public function index($id)
    {
        $projects = Project::all();
        $projectDetail = Project::with('exhibitions')->findOrFail($id);
        return view('projects', compact('projects', 'projectDetail'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|image',
            'title' => 'required',
            'description' => 'required',
        ]);
        $status = empty($request->id) ? 'Created' : 'Updated';
        $logoPath = Helpers::fileUpload($request->file, 'images/project-logo');

        $project = Project::updateOrCreate(
            ['id' => $request->id],
            [
                'logo' => $logoPath,
                'title' => $request->title,
                'description' => $request->description,
                'head_color' => $request->head_color,
                'bg_color' => $request->bg_color,
                'user_id' => auth()->user()->id
            ]
        );
        session()->flash('success', 'Project has been ' . $status . ' Successfully!');
        return back();
    }

    public function poiIndex($id)
    {
        $projects = Project::all();
        $exhibition = Exhibition::with(['pois' => function($q){
            $q->with('detail')->get();
        }])->find($id);
        return view('project-details', compact('projects', 'exhibition'));
    }

    public function poiStore(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $uniqueShortCode = $this->generateUniqueShortCode();
        $uniqueQRhash = $this->generateQRHash();
        $status = empty($request->poi_id) ? 'Created' : 'Updated';
        $poi = POI::updateOrCreate([
            'id' => $request->poi_id
        ], [
            'exhibition_id' => $id,
            'short_code' => $uniqueShortCode,
            'qr_hash' => $uniqueQRhash
        ]);

        $poiDetail = POIDetail::updateOrCreate([
            'id' => $request->detail_id,
        ],[
            'poi_id' => $poi->id,
            'title' => $request->title,
            'language' => 'en',
            'use_google_translate' => 0,
        ]);
        session()->flash('success', 'POI has been ' . $status . ' Successfully!');
        return back();
    }

    public function poiShow(Request $request,$id)
    {
        $projects = Project::all();
        $poi = POI::with('exhibition:id,project_id')->find($id);
        $agent = new Agent();
        $deviceType = $this->getDeviceType($agent);
        POIVisit::updateOrCreate(['device' => $request->userAgent()],[
            'poi_id' => $id,
            'project_id' => $poi->exhibition->project_id ?? '',
            'device' => $request->userAgent(),
            'device_type' => $deviceType,
            'visit_time' => now(),
        ]);
        return view('edit-details', compact('projects','poi'));
    }

    public function poiDestroy($id)
    {
        $poi = POI::find($id);
        if ($poi->delete()) {
            session()->flash('success', 'POI has been Deleted Successfully!');
        }else{
            session()->flash('error', 'Something Went Wrong!');
        }
        return back();
    }

    public function exhibitionStore(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ]);
        $status = empty($request->exhibition_id) ? 'Created' : 'Updated';
        $exhibition = Exhibition::updateOrCreate(['id' => $request->exhibition_id], [
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'project_id' => $id,
            'description' =>  $request->description,
        ]);
        session()->flash('success', 'Exhibition has been ' . $status . ' Successfully!');
        return back();
    }

    protected function generateUniqueShortCode($length = 6)
    {
        $shortCode = $this->generateRandomShortCode($length);
        while (POI::where('short_code', $shortCode)->exists()) {
            $shortCode = $this->generateRandomShortCode($length);
        }

        return $shortCode;
    }

    protected function generateRandomShortCode($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomShortCode = '';

        for ($i = 0; $i < $length; $i++) {
            $randomShortCode .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomShortCode;
    }

    protected function generateQRHash() {
        $uniqueId = uniqid();
        $hash = substr(md5($uniqueId), 0, 16);

        return $hash;
    }

    private function getDeviceType($agent)
    {
        if ($agent->isDesktop()) {
            return 'Computer';
        } elseif ($agent->isTablet()) {
            return 'Tablet';
        } elseif ($agent->isMobile()) {
            return 'Phone';
        } else {
            return 'Unknown';
        }
    }
}
