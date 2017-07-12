<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Modules\Leave\Entities\LeaveLedger;

use DB;
class updateLeaveLedger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateLeaveLedger:updateactivetoinactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "updates the leave application's active status";

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
     * change the flag of the leave ledger as inactive after the last day of the leave date is gone
     * @return mixed
     */
    public function handle()
    { 
        $today=date('Y-m-d');

        LeaveLedger::where('to_date', '<=',$today)
        ->where('deleted_at',NULL)
        ->where('active',1)
        ->update(['active'=>0]);

    }
}
