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
        'channel' => 'number'
    ];
}
