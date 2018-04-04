<?php

namespace App\Console\Commands;

use App\Models\Corporation;
use App\Models\Structure;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateStructures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'structures:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loops through all the corporations and updates the structures in the database.';

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
        \Log::info('Updating structures.');
        try {

            $start = new Carbon();

            $corporations = Corporation::get();
            foreach ($corporations as $corporation) {
                Structure::UpdateStructures($corporation);
            }

            //Purge old Structures
            Structure::where('updated_at', '<', $start)->delete();

            \Log::info('Structure update complete.');

        } catch (\Exception $e) {
            \Log::info('Structure update failed:' . $e);
        }

    }
}
