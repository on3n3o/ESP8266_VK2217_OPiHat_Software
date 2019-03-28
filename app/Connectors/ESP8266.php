<?php

namespace App\Connectors;

use lepiaf\SerialPort\SerialPort;
use lepiaf\SerialPort\Parser\SeparatorParser;
use lepiaf\SerialPort\Configure\TTYConfigure;

class ESP8266
{
    protected $file = null;

    public function __construct(){
        // $configure = new TTYConfigure();
        // //change baud rate
        // $configure->removeOption("9600");
        // $configure->setOption("115200");
        // $serialPort = new SerialPort(new SeparatorParser(), $configure);
        // $serialPort->open("/dev/ttyS1");
        // $this->connection = $serialPort;
        exec('../../scripts/esp.sh');
        $this->file = file_get_contents('../../scripts/ttyDump.dat');
    }

    public function getNetworks(){
        return $this->file;
        // while ($data = $this->connection->read()) {
        //     $this->connection->write('AT+CWLAP\r\n');
        //     if ($data === '\r\n') {
        //         $this->connection->close();
        //         return $data;
        //     }
        // }
    }
}