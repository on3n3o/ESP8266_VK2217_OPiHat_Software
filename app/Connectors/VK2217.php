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
    }

    public function disconnect(){
        $this->connection->close();
    }

    public function getGPS(){
        while ($data = $this->connection->read()) {
            if (substr($data, 0, 6) === '$GPRMC') {
                return $data;
            }
        }
    }
}