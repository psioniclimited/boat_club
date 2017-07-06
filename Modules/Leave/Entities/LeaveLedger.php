<?php

namespace Modules\Leave\Entities;


use Modules\Organization\Entities\LeaveType;
use Modules\Organization\Entities\WeekHolidayMaster;
use Modules\Organization\Entities\HolidayList;
use Modules\Employee\Entities\EmployeeMaster;
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



	public function setWorkingDaysAndPayTypeAttributeManually($request){

		$leave_type=LeaveType::find($request->leave_type_id);  
		$employees_master=EmployeeMaster::find($request->employees_master_id);

		$employee_job_info=$employees_master->employee_job_info[0];
		$working_days=$this->getWorkingDays($employee_job_info, $request->from_date, $request->to_date);
 
		$this->attributes['paytype'] = $leave_type->payment_type; 
		$this->attributes['working_days'] = $working_days;
		$this->save();
	}



	public function getWorkingDays($employee_job_info,$from_date,$to_date){ 

		$holiday_list=$this->getHolidayList(HolidayList::find($employee_job_info->holiday_list_id),$from_date,$to_date);
		$weekend_carbon_codes=$this->getWeekendCodes(WeekHolidayMaster::find($employee_job_info->week_holiday_master_id),$from_date,$to_date);

		$number_of_days = ((strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24))+1;

		$date=$from_date;

		while (strtotime($date) <= strtotime($to_date)) { 
			$day = new \Carbon\Carbon($date);

			if (in_array($date , $holiday_list) || in_array($day->dayOfWeek , $weekend_carbon_codes)) {  
				$number_of_days--;
			} 
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		}		


		return $number_of_days;

	}


	public function getHolidayList($holiday_list,$from_date,$to_date){

		$list_of_holidays=array();

		$holidays=$holiday_list ->holiday
		->where('holiday_date','>=',$from_date)
		->where('holiday_date','<=',$to_date);


		foreach ($holidays as $row ) {
			array_push($list_of_holidays, $row->holiday_date);
		}

		return  $list_of_holidays;
	}

	public function getWeekendCodes($week_holiday_master,$from_date,$to_date){

		$weekend_carbon_codes=array();
		$holidays=$week_holiday_master->week_holiday; 
		foreach ($holidays as $row) { 
			array_push($weekend_carbon_codes, $row->day_name->carbon_value);
		}
		
		return  $weekend_carbon_codes;
	}


}
