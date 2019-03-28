<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Network;
use App\NetworkPosition;
use App\Position;

class FlushTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flush:tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command flushes tables with data';

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
        DB::statement("SET foreign_key_checks=0");
        Network::truncate();
        Position::truncate();
        NetworkPosition::truncate();
        DB::statement("SET foreign_key_checks=1");
    }
}
