<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Position;

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
    protected $description = 'This command calculates best viable position for network';

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
     * Weź wszystkie pozycje z ostatnich 5 minut i je przeanalizuj biorąc wszystkie poprzednie odczyty tych sieci
     *
     * @return mixed
     */
    public function handle()
    {
        $date_from = Carbon::now()->subMinutes(5);
        $date_to = Carbon::now();
        $positions = Position::whereBetween('updated_at', [$date_from, $date_to])->get();
        foreach($positions as $position){
            $networks = $position->networks;
            foreach($networks as $network){
                $network->recalculate();
            }
        }
    }
}
