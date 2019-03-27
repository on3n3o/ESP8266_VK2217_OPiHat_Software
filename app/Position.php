<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = [
        'lat', 'lng'
    ];

    protected $casts = [
        'lat' => 'double', 
        'lng' => 'double'
    ];

    public function networkPositions()
    {
        return $this->hasMany(NetworkPosition::class);
    }

    public function networks()
    {
        return $this->belongsToMany(Network::class, 'network_position')->withPivot('db');
    }
}
