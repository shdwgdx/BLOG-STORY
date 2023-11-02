<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
    public function images()
    {
        return $this->hasMany(Blog_image::class);
    }

    public function videos()
    {
        return $this->hasMany(Blog_video::class);
    }
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
