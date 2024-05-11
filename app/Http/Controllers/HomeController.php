<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->is_admin != true){
            return redirect(route('projects.index',auth()->user()->project->id));
        }
        if(auth()->user()->is_admin == true){
            $projects = Project::all();
        }else{
            $projects = Project::where('user_id',auth()->user()->id)->get();
        }
        return view('home', compact('projects'));
    }
}
