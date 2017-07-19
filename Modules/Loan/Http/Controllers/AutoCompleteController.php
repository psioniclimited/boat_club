<?php

namespace Modules\Loan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Loan\Entities\LoanApplication;
use Modules\Loan\Entities\LoanStatus;
 
use DB;
 

class AutoCompleteController extends Controller
{ 
 

	public function getEmployeesOfLoanApplication(Request $request)
	{   
		$loan_application_id = $request->input('loan_application_id');

		$employees_master = LoanApplication::with(['employees_master'=> function($query){
			$query->select('id','employee_fullname','contact_number', 'employee_code as text'); 
		}])
		->find($loan_application_id)->employees_master;
		return response()->json($employees_master);
	}
	
	public function getLoanTypeOfLoanApplication(Request $request)
	{   
		$loan_application_id = $request->input('loan_application_id');

		$loan_types = LoanApplication::with(['loan_type'=> function($query){
			$query->select('id', 'loan_type_name as text'); 
		}])
		->find($loan_application_id)->loan_type;
		return response()->json($loan_types);
	}

 


}

