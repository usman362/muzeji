<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Helpers\Helpers;
use App\Models\Exhibition;
use App\Models\POI;
use App\Models\POIDetail;
use App\Models\POIMedia;
use App\Models\POIVisit;
use App\Models\Project;
use App\Models\ProjectHistory;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Jenssegers\Agent\Agent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProjectController extends Controller
{
    public function index($id)
    {
        if (auth()->user()->is_admin == true) {
            $projects = Project::all();
            $projectDetail = Project::with('exhibitions')->findOrFail($id);
        } else {
            $projects = Project::where('user_id', auth()->user()->id)->get();
            $projectDetail = Project::with('exhibitions')->where('user_id',auth()->user()->id)->findOrFail($id);
        }
        return view('projects', compact('projects', 'projectDetail'));
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'file' => 'required|file|image',
                'title' => 'required|unique:users,email',
                'description' => 'required',
            ]);
            $status = empty($request->id) ? 'Created' : 'Updated';
            $logoPath = Helpers::fileUpload($request->file, 'images/project-logo');
            $randomPass = $this->generateRandomShortCode(8);
            $password = Hash::make($randomPass);
            $user = User::create([
                'email' => $request->title,
                'name' => $request->description,
                'password' => $password,
                'is_admin' => 0
            ]);
            $project = Project::updateOrCreate(
                ['id' => $request->id],
                [
                    'logo' => $logoPath,
                    'title' => $request->title,
                    'description' => $request->description,
                    'head_color' => $request->head_color,
                    'bg_color' => $request->bg_color,
                    'user_id' => $user->id
                ]
            );
            ProjectHistory::create([
                'poi_id' => 0,
                'project_id' => $project->id,
                'description' => 'Project Created',
            ]);
            event(new UserCreated($user, $randomPass));
            session()->flash('success', 'Project has been ' . $status . ' Successfully!');
            return back();
        } catch (Exception $e) {
            session()->flash('error', $e);
            return back();
        }
    }

    public function poiIndex($id)
    {
        if (auth()->user()->is_admin == true) {
            $projects = Project::all();
            $exhibition = Exhibition::with(['pois' => function ($q) {
                $q->with('detail')->get();
            }])->findOrFail($id);
        } else {
            $projects = Project::where('user_id', auth()->user()->id)->get();
            $exhibition = Exhibition::with(['pois' => function ($q) {
                $q->with('detail')->get();
            }])->whereHas('project',function($q){
                $q->where('user_id', auth()->user()->id);
            })->findOrFail($id);
        }
        return view('project-details', compact('projects', 'exhibition'));
    }

    public function poiStore(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
            ]);
            $uniqueShortCode = $this->generateUniqueShortCode();
            $uniqueQRhash = $this->generateQRHash();
            $status = empty($request->poi_id) ? 'Created' : 'Updated';
            $poi = POI::updateOrCreate([
                'id' => $request->poi_id
            ], [
                'title' => $request->title,
                'exhibition_id' => $id,
                'short_code' => $uniqueShortCode,
                'qr_hash' => $uniqueQRhash
            ]);

            $poiDetail = POIDetail::updateOrCreate([
                'id' => $request->detail_id,
            ], [
                'poi_id' => $poi->id,
                'title' => $request->title,
                'language' => 'en',
                'flag' => 'uk',
                'use_google_translate' => 0,
            ]);
            ProjectHistory::create([
                'poi_id' => $poi->id,
                'project_id' => $poi->exhibition->project->id,
                'description' => $request->title . ' POI ' . $status . ' for this Project',
            ]);
            session()->flash('success', 'POI has been ' . $status . ' Successfully!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', $e);
            return back();
        }
    }

    public function poiShow(Request $request, $id, $qrcode = null)
    {
        $poi = POI::query()->with(['exhibition:id,project_id', 'details' => function ($q) {
            $q->with(['images', 'audio', 'video']);
        }])->where('short_code', $id);
        if (!empty($qrcode)) {
            $poi->where('qr_hash', $qrcode);
        }
        $poi = $poi->firstOrFail();
        $agent = new Agent();
        $deviceType = $this->getDeviceType($agent);
        if (!empty($poi)) {
            POIVisit::updateOrCreate(['device' => $request->userAgent()], [
                'poi_id' => $poi->id,
                'project_id' => $poi->exhibition->project_id ?? '',
                'device' => $request->userAgent(),
                'device_type' => $deviceType,
                'link_type' => !empty($qrcode) ? 'qrcode' : 'short_code',
                'visit_time' => now(),
            ]);
        }
        return view('poi-details', compact('poi'));
    }

    public function poiEdit(Request $request, $id)
    {
        if (auth()->user()->is_admin == true) {
            $projects = Project::all();
            $poi = POI::with('exhibition:id,project_id')->findOrFail($id);
        } else {
            $projects = Project::where('user_id', auth()->user()->id)->get();
            $poi = POI::whereHas('exhibition', function ($q) {
                $q->whereHas('project',function($p){
                    $p->where('user_id', auth()->user()->id);
                });
            })->findOrFail($id);
        }
        return view('edit-details', compact('projects', 'poi'));
    }

    public function poiUpdate(Request $request, $id)
    {
        try {
            if (auth()->user()->is_admin == true) {
                $poi = POI::with('exhibition:id,project_id')->findOrFail($id);
            } else {
                $poi = POI::whereHas('exhibition', function ($q) {
                    $q->whereHas('project',function($p){
                        $p->where('user_id', auth()->user()->id);
                    });
                })->findOrFail($id);
            }
            if (!empty($request->main_title)) {
                $poi->title = $request->main_title;
                $poi->save();
            }
            foreach ($request->main_id as $key => $mainId) {
                $detail = POIDetail::updateOrCreate(['id' => $mainId], [
                    'poi_id' => $id,
                    'title' => $request->title[$key],
                    'description' => $request->description[$key],
                    'language' => $request->language[$key],
                    'flag' => $request->flag[$key],
                ]);

                if (!empty(request('logo' . $key))) {
                    foreach (request('logo' . $key) as $logoKey => $logo) {
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
                    foreach (request('audio' . $key) as $audioKey => $audio) {
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
                ProjectHistory::create([
                    'poi_id' => $poi->id,
                    'project_id' => $poi->exhibition->project->id,
                    'description' => $detail->title . ' POI Detail Updated for this Project',
                ]);
            }

            session()->flash('success', 'POI has been Updated Successfully!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', $e);
            return back();
        }
    }

    public function poiDestroy($id)
    {
        $poi = POI::find($id);
        if ($poi->delete()) {
            session()->flash('success', 'POI has been Deleted Successfully!');
        } else {
            session()->flash('error', 'Something Went Wrong!');
        }

        ProjectHistory::create([
            'poi_id' => $poi->id,
            'project_id' => $poi->exhibition->project->id,
            'description' => $poi->title . ' POI Detail Deleted for this Project',
        ]);
        return back();
    }

    public function exhibitionStore(Request $request, $id)
    {
        try {

            $request->validate([
                'title' => 'required',
            ]);
            if (auth()->user()->is_admin == true) {
                $project = Project::find($id);
            } else {
                $project = Project::where('user_id', auth()->user()->id)->find($id);
            }
            $status = empty($request->exhibition_id) ? 'Created' : 'Updated';
            $exhibition = Exhibition::updateOrCreate(['id' => $request->exhibition_id], [
                'title' => $request->title,
                'user_id' => $project->user_id ?? auth()->user()->id,
                'project_id' => $id,
                'description' =>  $request->description,
            ]);
            ProjectHistory::create([
                'poi_id' => 0,
                'project_id' => $exhibition->project_id,
                'description' => $request->title . ' Exhibition ' . $status . ' for this Project',
            ]);
            session()->flash('success', 'Exhibition has been ' . $status . ' Successfully!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', $e);
            return back();
        }
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

    protected function generateQRHash()
    {
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

    public function qrcode_download(Project $redirect, $short_code, $qrcode)
    {
        $url = URL::to('/') . '/poi/' . $short_code . '/viewpoint/' . $qrcode;
        $pngImage = QrCode::size(400)->format('svg')->generate($url);
        Storage::disk('public')->makeDirectory('qrcodes');
        $fileName = 'qr_code.svg';
        $fileDest = storage_path('app/public/qrcodes/' . $fileName);

        QrCode::size(400)->format('svg')->generate($url, $fileDest);
        if (file_exists($fileDest)) {
            return response()->download($fileDest, $fileName);
        } else {
            return response()->json(['error' => 'Failed to generate QR code'], 500);
        }
    }

    public function short_code()
    {
        return view('short_code');
    }

    public function short_code_view(Request $request)
    {
        if (auth()->user()->is_admin == true) {
            $poi = POI::query()->with(['exhibition:id,project_id', 'details' => function ($q) {
                $q->with(['images', 'audio', 'video']);
            }])->where('short_code', $request->short_code);
        } else {
            $poi = POI::query()->with(['details' => function ($q) {
                $q->with(['images', 'audio', 'video']);
            }])->whereHas('exhibition', function ($q) {
                $q->whereHas('project',function($p){
                    $p->where('user_id', auth()->user()->id);
                });
            })->where('short_code', $request->short_code);
        }
        $poi = $poi->first();
        if (empty($poi)) {
            session()->flash('error', 'POI Not Found from this Short Code!');
            return back();
        }
        return redirect(route('poi.show', $request->short_code));
    }

    public function deleteMedia(Request $request, $id)
    {
        try {
            $media = POIMedia::find($id);
            if ($media->delete()) {
                return response()->json(['success' => 'Media Deleted Successfully']);
            }else{
                return response()->json(['error' => 'Something Went Wrong!']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
