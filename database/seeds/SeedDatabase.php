<?php

use Illuminate\Database\Seeder;
use App\Network;
use App\Position;
use App\NetworkPosition;
use App\CalculatedPosition;

class SeedDatabase extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $network1 = Network::create([
            'name' => 'eulan.pl', 
            'mac' => '00:0A:E6:3E:FD:E1', 
            'channel' => 14
        ]);

        $network2 = Network::create([
            'name' => 'test', 
            'mac' => '00:0A:E6:3E:FD:E2', 
            'channel' => 12
        ]);

        $position1 = Position::create([
            'lat' => '53.125',
            'lng' => '18.01',
        ]);

        $position2 = Position::create([
            'lat' => '53.125',
            'lng' => '18.02',
        ]);

        $position3 = Position::create([
            'lat' => '53.125',
            'lng' => '18.03',
        ]);

        $networkPosition1 = NetworkPosition::create([
            'network_id' => $network1->id,
            'position_id' => $position1->id,
            'db' => 20,
        ]);

        $networkPosition1 = NetworkPosition::create([
            'network_id' => $network1->id,
            'position_id' => $position2->id,
            'db' => 30,
        ]);

        $networkPosition1 = NetworkPosition::create([
            'network_id' => $network1->id,
            'position_id' => $position3->id,
            'db' => 40,
        ]);

        $networkPosition2 = NetworkPosition::create([
            'network_id' => $network2->id,
            'position_id' => $position1->id,
            'db' => 90,
        ]);
    }
}
