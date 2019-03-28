<?php

namespace App\Connectors;

use lepiaf\SerialPort\SerialPort;
use lepiaf\SerialPort\Parser\SeparatorParser;
use lepiaf\SerialPort\Configure\TTYConfigure;

class ESP8266
{
    protected $file = null;

    public function __construct(){
        exec(__DIR__ . '/../../scripts/esp.sh');
        $this->file = file_get_contents(__DIR__ . '/../../scripts/ttyDump.dat');
    }

    public function getNetworks(){
        return $this->file;
    }

    public function getFormattedNetworks(){
        $networks_raw =  explode('+CWLAP:', 
            str_replace(')', '', 
                str_replace('(', '', 
                    str_replace('OK', '', 
                        str_replace("\r\n", '', $this->getNetworks())
                    )
                )
            )
        );

        $networks = [];
        for($i = 1 ;$i < count($networks_raw); $i++){
            $network = explode(',', $networks_raw[$i]);
            $networks[] = [
                'name' => str_replace("\"", '', $network[1]),
                'mac' => str_replace("\"", '', $network[3]),
                'db' => $network[2],
                'channel' => $network[4]
            ];
        }
        return $networks;
    }
}