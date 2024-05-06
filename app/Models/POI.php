<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POI extends Model
{
    use HasFactory;

    protected $fillable = [
        'exhibition_id',
        'short_code',
        'qr_hash'
    ];

    public function detail()
    {
        return $this->belongsTo(POIDetail::class, 'id','poi_id');
    }

    public function details()
    {
        return $this->hasMany(POIDetail::class, 'poi_id','id');
    }

    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class, 'exhibition_id','id');
    }

    public function visits()
    {
        return $this->hasMany(POIVisit::class, 'poi_id', 'id');
    }
}
