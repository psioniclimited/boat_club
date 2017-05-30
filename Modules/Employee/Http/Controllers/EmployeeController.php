<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Validator;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('employee::employee.employee_list');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('employee::employee.create_employee');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     * there are two steps of validation on this method
     * the first step validation EmployeeCreateRequest checks the single form elements
     * the second level validation checks the redundant elements that is the table data 
     */
    public function store(\Modules\Employee\Http\Requests\EmployeeCreateRequest $request)
    { 
        $tableValidation=$this->validateTableData($request);
        if($tableValidation[0]==false){ 
            return response()->json(['error' => $tableValidation[1]]); 
        }

       // dd($request->all());
    }

    public $tableValidationRules=[
    array(
        'salary_head_id' =>'required|exists:salary_head,id' , 
        'amount' =>'numeric'
        ),
    array(
        'institution' =>'required', 
        'degree_name' =>'required',
        'passing_year' =>'required'
        ),
    array(
        'institution' =>'required', 
        'designation' =>'required',
        'from_date' =>'required',
        'to_date' =>'required'
        ),
    array(
        'department_branch_id' =>'required', 
        'department_id' =>'required',
        'designation_id' =>'required',
        'remarks' =>'required'
        ),
    array(
        'family_member_name' =>'required', 
        'date_of_birth' =>'required',
        'family_relation_id' =>'required', 
        )
    ];

    public function validateTableData($request){

        if(!$this->requestValidation($request->salary_details,$this->tableValidationRules[0])){

            return [false,"The Salary Details Table is incomplete!"];
        }
        if(!$this->requestValidation($request->educational_background,$this->tableValidationRules[1])){ 

            return [false,'The Educational Background Table is incomplete!'];
        }
        if(!$this->requestValidation($request->previous_work_history,$this->tableValidationRules[2])){

            return [false,'The Previous History Table is incomplete!'];
        }
        if(!$this->requestValidation($request->history_inside_organization,$this->tableValidationRules[3])){

            return [false,'The History Inside Organization Table is incomplete!'];
        }

        if(!$this->requestValidation($request->family_information,$this->tableValidationRules[4])){

            return [false,'The Family Information Table is incomplete!'];
        }
        return [true,'success'];
    }

    public function requestValidation($request_name,$rules){ 
        $data=json_decode($request_name,true); 
        if($data[0]!=[]){
            foreach ($data as $row) {  
                if(!$this->validateDetails($row,$rules)){ 
                    return false; 
                }
            }        
        }
        return true; 
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('employee::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('employee::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function checkUniqueEmployeeCode(Request $request)
    {  
        // $employee_code=$request->employee_code;

        return response()->json(false);
        
    }


    public function validateDetails($data,$rules){

     $validator = Validator::make($data,$rules);

     if ($validator->fails())
     { 
        return false;
    }
    return true;
}
}
