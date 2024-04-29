<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POIVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'poi_id',
        'project_id',
        'device',
        'device_type',
        'visit_time'
    ];
}
