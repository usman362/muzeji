<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'logo',
        'head_color',
        'bg_color',
        'splash_color',
        'splash',
        'user_id'
    ];

    public function exhibitions()
    {
        return $this->hasMany(Exhibition::class, 'project_id', 'id');
    }

    public function visits()
    {
        return $this->hasMany(POIVisit::class, 'project_id', 'id');
    }
}
