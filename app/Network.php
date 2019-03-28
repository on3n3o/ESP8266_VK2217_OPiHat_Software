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

    public function recalculate()
    {
        $sel_position = null;
        $min_db = 999;
        $positions = $this->positions()->get();
        //find best candidate
        foreach($positions as $position){
            if(abs($position->pivot->db) < $min_db){
                $min_db = abs($position->pivot->db);
                $sel_position = $position;
            }
        }

        if($sel_position){
            $this->calculatedPosition()->delete();
            return $this->calculatedPosition()->create([
                'lat' => $position->lat,
                'lng' => $position->lng,
                'size' => $this->calculateSize($position->pivot->db)
            ]);
        }
    }

    protected function calculateSize($db)
    {
        return sqrt(abs($db));
    }
}
