<?php

namespace App\Connectors;

use lepiaf\SerialPort\SerialPort;
use lepiaf\SerialPort\Parser\SeparatorParser;
use lepiaf\SerialPort\Configure\TTYConfigure;

class VK2217
{
    protected $connection = null;

    public function __construct(){
        $this->connection = new SerialPort(new SeparatorParser(), new TTYConfigure());
    }

    public function connect(){
        $this->connection->open("/dev/ttyS2");
        return $this;
    }

    public function disconnect(){
        $this->connection->close();
        return $this;
    }

    public function getGPS(){
        while ($data = $this->connection->read()) {
            if (substr($data, 0, 6) === '$GPRMC') {
                return $data;
            }
        }
    }

    public function getFormattedGPS(){
        $raw = explode(',', $this->getGPS());
        return [
            'status' => $raw[2],
            'lat' => $raw[3],
            'lng' => $raw[4]
        ];
    }
}