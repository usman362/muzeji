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
        'flag',
        'use_google_translate'
    ];


    public function media()
    {
        return $this->belongsTo(POIMedia::class, 'id', 'detail_id')->where('type','logo');
    }

    public function audio()
    {
        return $this->belongsTo(POIMedia::class, 'id', 'detail_id')->where('type','audio');
    }

    public function audios()
    {
        return $this->hasMany(POIMedia::class, 'detail_id', 'id')->where('type','audio');
    }

    public function video()
    {
        return $this->belongsTo(POIMedia::class, 'id', 'detail_id')->where('type','video');
    }

    public function object()
    {
        return $this->belongsTo(POIMedia::class, 'id', 'detail_id')->where('type','object');
    }

    public function images()
    {
        return $this->hasMany(POIMedia::class, 'detail_id', 'id')->where('type','logo');
    }
}
