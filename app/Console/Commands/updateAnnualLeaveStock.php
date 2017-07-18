<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Modules\Leave\Entities\LeaveLedger;

use DB;
class updateAnnualLeaveStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateAnnualLeaveStock:addCarryForwards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "adds the leave not used in previous year";

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
 
        DB::table('employees_master')
        ->where('employees_master.deleted_at',NULL)
        ->where('employees_master.employee_status',1)
        ->join('leave_package','leave_package.id','=','employees_master.leave_package_id') 
        ->join('leave_package_details','leave_package_details.leave_package_id','=','leave_package.id') 
        ->join('leave_type','leave_type.id','=','leave_package.leave_type_id') 
        ->where('leave_type.carry_forward',1)
        ->join('leave_stock', function($join)
        {
           $join->on('leave_stock.leave_type_id', '=', 'leave_type.id');
           $join->on('leave_stock.employees_master_id', '=', 'employees_master.id');

       })
        ->where('leave_stock.deleted_at',NULL)
        ->update(['leave_stock.number_of_days'=>'leave_stock.number_of_days'+'leave_package_details.number_of_days']);



    }
}
