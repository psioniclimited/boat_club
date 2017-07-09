<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Leave\Entities\LeaveLedger;
 
use DB;
 

class AutoCompleteController extends Controller
{ 
 

	public function getEmployeesOfLeaveLedger(Request $request)
	{   
		$leave_ledger_id = $request->input('leave_ledger_id');

		$employees_master = LeaveLedger::with(['employees_master'=> function($query){
			$query->select('id','employee_fullname','contact_number', 'employee_code as text'); 
		}])
		->find($leave_ledger_id)->employees_master;
		return response()->json($employees_master);
	}
	
	public function getLeaveTypeOfLeaveLedger(Request $request)
	{   
		$leave_ledger_id = $request->input('leave_ledger_id');

		$leave_types = LeaveLedger::with(['leave_type'=> function($query){
			$query->select('id', 'leave_type_name as text'); 
		}])
		->find($leave_ledger_id)->leave_type;
		return response()->json($leave_types);
	}

 


}

