<?php

namespace App\Connectors;

use lepiaf\SerialPort\SerialPort;
use lepiaf\SerialPort\Parser\SeparatorParser;
use lepiaf\SerialPort\Configure\TTYConfigure;

class ESP
{
    protected $connection = null;

    public function __construct(){
        $configure = new TTYConfigure();
        //change baud rate
        $configure->removeOption("9600");
        $configure->setOption("115200");
        $serialPort = new SerialPort(new SeparatorParser(), $configure);
        $serialPort->open("/dev/ttyS1");
        $this->connection = $serialPort;
    }

    public function getNetworks(){
        while ($data = $this->connection->read()) {
            $this->connection->write('AT+CWLAP\r\n');
            if ($data === '\r\n') {
                $this->connection->close();
                return $data;
            }
        }
    }
}