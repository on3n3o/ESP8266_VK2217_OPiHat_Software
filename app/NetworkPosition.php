<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NetworkPosition extends Model
{
    protected $table = 'network_position';

    protected $fillable = [
        'position_id', 'network_id', 'db'
    ];

    protected $casts = [
        'position_id' => 'integer',
        'network_id' => 'integer',
        'db' => 'double'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function network()
    {
        return $this->belongsTo(Network::class);
    }
}
