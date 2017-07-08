<?php

namespace Modules\Leave\Entities;


use Modules\Organization\Entities\LeaveType;
use Modules\Organization\Entities\WeekHolidayMaster;
use Modules\Organization\Entities\HolidayList;
use Modules\Employee\Entities\EmployeeMaster;
use Illuminate\Database\Eloquent\Model; 
use File; 

class LeaveStatus extends Model
{ 
	protected $table = 'leave_status';
	
	protected $fillable = ['status_name','change_type'];
	
	public $timestamps=false; 


	public function leave_ledger()
	{  
		return $this->hasMany('Modules\Leave\Entities\LeaveLedger','leave_ledger_id'); 
	}
 
}
