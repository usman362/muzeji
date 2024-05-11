<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'project_id'
    ];

    public function pois()
    {
        return $this->hasMany(POI::class, 'exhibition_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id','id');
    }
}
