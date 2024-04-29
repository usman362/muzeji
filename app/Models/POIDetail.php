<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POIDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'poi_id',
        'language',
        'title',
        'description',
        'use_google_translate'
    ];
}
