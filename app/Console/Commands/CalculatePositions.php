<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Network;
use App\Position;
use App\NetworkPosition;
use App\CalculatedPosition;

class CalculatePositions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:positions';

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
        $date_from = Carbon::now()->subMinute();
        $date_to = Carbon::now();
        $positions = Position::whereBetween('updated_at', [$date_from, $date_to])->get();
        $positions
        // Weź wszystkie pozycje z ostatniej minuty i je przeanalizuj biorąc wszystkie poprzednie odczyty tych sieci
    }
}
