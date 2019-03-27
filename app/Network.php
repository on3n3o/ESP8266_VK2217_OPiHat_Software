<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $table = "networks";

    protected $fillable = [
        'name', 'mac', 'channel'
    ];

    protected $casts = [
        'channel' => 'integer'
    ];

    public function networkPositions()
    {
        return $this->hasMany(NetworkPosition::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'network_position')->withPivot('db');
    }

    public function calculatedPosition()
    {
        return $this->hasOne(CalculatedPosition::class);
    }
}
