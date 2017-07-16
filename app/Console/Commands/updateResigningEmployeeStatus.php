<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Employee\Entities\EmployeeMaster;
class updateResigningEmployeeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateResigningEmployeeStatus:setAsInactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Relieves the resigning employee and sets his status as inactive';

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
        //
        $today=date('Y-m-d');

        DB::table('employees_master')
        ->where('employees_master.deleted_at',NULL)
        ->where('employees_master.active',1)
        ->join('employee_job_info','employee_job_info.employees_master_id','=','employees_master.id')
        ->where('employee_job_info.deleted_at',NULL)
        ->where('employee_job_info.relieving_date',$today)
        ->update(['employees_master.active'=>0]);
    }
}
