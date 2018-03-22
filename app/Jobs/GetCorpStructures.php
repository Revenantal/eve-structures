<?php

namespace App\Jobs;

use App\Models\Corporation;
use App\Models\Structure;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetCorpStructures
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $corp;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Corporation $corp)
    {
        $this->corp = $corp;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Structure::UpdateStructures($this->corp);
    }
}
