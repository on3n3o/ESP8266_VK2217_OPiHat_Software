<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalculatedPosition extends Model
{
    protected $table = 'calculated_positions';

    protected $fillable = [
        'network_id', 'lat', 'lng', 'size'
    ];

    protected $casts = [
        'network_id' => 'integer',
        'size' => 'double'
    ];

    public function network(){
        return $this->belongsTo(Network::class);
    }
}
