<?php

namespace App\Helpers;

use App\Models\POIVisit;
use Config;
use Illuminate\Support\Str;

class Helpers
{

  public static function fileUpload($uploadedFile,$folder = null){

    // Generate a unique name for the file, or use the original file name
    $uniqueName = uniqid() . '___' . str_replace(' ', '_', $uploadedFile->getClientOriginalName());

    // Get the folder name from the request or use 'files' as the default folder
    $folder = $folder ?? 'files';

    // Store the file in the 'public' disk (configured in config/filesystems.php)
    $filePath = $uploadedFile->storeAs("/{$folder}", $uniqueName, "public");

    return $filePath;

  }

  public static function getViews($id,$month){
    $views = POIVisit::where('poi_id',$id)->whereMonth('visit_time',$month)->whereYear('visit_time',date("Y"))->count();
    return $views;
  }

}
