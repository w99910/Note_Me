<?php

namespace App\Console\Commands;

use App\Models\Note_Scheduler;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SendNoti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:noti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Noti';

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
        $sche=Note_Scheduler::find(14);
        $sche->updated_at=Carbon::now();
        Log::info($sche);
        $sche->save();
    }
}
