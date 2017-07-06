<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;

class LeaveLedger extends Model
{
	use SoftDeletes;
	protected $table = 'leave_ledger';
	
	protected $fillable = ['from_date','to_date','status','working_days','paytype','employees_master_id','leave_type_id'];
	
	public $timestamps=true;
	protected $dates = ['deleted_at'];

 
	public function employees_master()
	{  
		return $this->belongsTo('Modules\Employee\Entities\EmployeeMaster','employees_master_id'); 
	}

	public function leave_type()
	{  
		return $this->belongsTo('Modules\Organization\Entities\LeaveType','leave_type_id'); 
	}


}
