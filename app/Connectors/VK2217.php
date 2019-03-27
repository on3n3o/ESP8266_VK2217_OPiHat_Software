<?php

namespace App\Connectors;

use lepiaf\SerialPort\SerialPort;
use lepiaf\SerialPort\Parser\SeparatorParser;
use lepiaf\SerialPort\Configure\TTYConfigure;

class VK2217
{
    protected $connection = null;

    public function __construct(){
        
        $serialPort = new SerialPort(new SeparatorParser(), new TTYConfigure());
        $serialPort->open("/dev/ttyS2");
        $this->connection = $serialPort;
    }

    public function getGPS(){
        while ($data = $this->connection->read()) {
            //$this->connection->write('AT+CWLAP\r\n');
            if ($data === '$something') {
                $this->connection->close();
                return $data;
            }
        }
    }
}