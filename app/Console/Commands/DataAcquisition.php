<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Connectors\VK2217;
use App\Connectors\ESP8266;
use App\Network;
use App\NetworkPosition;

class DataAcquisition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:acquisition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * Every minute check GPS and get networks and save them to database
         */
        $gps = new VK2217();
        $gps->connect();
        $wifi = new ESP8266();
        $gpsData = $gps->getFormattedGPS();
        $networkData = $wifi->getFormattedNetworks();
        $gps->disconnect();

        //if($gpsData['status' === 'A']){ //A - OK, V - ERROR
            if(count($networkData) > 0){
                foreach($networkData as $network){
                    $net = Network::firstOrCreate([
                        'name' => $network['name'],
                        'mac' => $network['mac'],
                        'channel' => $network['channel']
                    ]);
                    $position = Position::firstOrCreate([
                        'lat' => $gpsData['lat'],
                        'lng' => $gpsData['lng']
                    ]);
                    $network_position = NetworkPosition::create([
                        'netowrk_id' => $net->id,
                        'position_id' => $position->id,
                        'db' => $network['db']
                    ]);
                }
            }
        //}
    }
}
