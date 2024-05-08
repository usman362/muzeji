<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POIMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'poi_id', 'type', 'media_url','detail_id'
    ];
}
