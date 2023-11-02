<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function locations()
    {
        return $this->hasManyThrough(Location::class, Day::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function availabilities()
    {
        return $this->belongsToMany(Availability::class);
    }
    public function regions()
    {
        return $this->belongsToMany(Region::class);
    }
    public function days()
    {
        return $this->hasMany(Day::class);
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
