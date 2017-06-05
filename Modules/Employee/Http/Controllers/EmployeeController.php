<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\EmployeeMaster;
use Modules\Employee\Entities\EmployeeJobInfo;
use Modules\Employee\Entities\EmployeeSalaryInformation;
use Modules\Employee\Entities\EmployeeWorkHistoryInCompany;
use Datatables; 
use URL;
use \Modules\Helpers\DatatableHelper;
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

    }
    public function createEmployee()
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

        $employees_master=EmployeeMaster::create($request->all()); 

        $data=$request->all();

        $data['employees_master_id']=$employees_master->id;
        $employee_job_info=EmployeeJobInfo::create($data);

        $data['employee_job_info_id']=$employee_job_info->id;
        $employee_salary_info=EmployeeSalaryInformation::create($data);
 
        $data['remarks']="Joined the Organization";
        EmployeeWorkHistoryInCompany::create($data);
        
        $employee_salary_info->employee_salary_details()->createMany(json_decode($request->salary_details,true));

        $this->batchInsert($employees_master->employee_family_members(),$request->family_information);

        $this->batchInsert($employees_master->employee_educational_background(),$request->educational_background);
        
        $this->batchInsert($employees_master->employee_previous_job_experience(),$request->previous_work_history);

        $this->batchInsert($employees_master->employee_work_history_inside_company(),$request->history_inside_organization);

        // return response()->json('success'); 
        // return json_encode(value)(); 
        // return redirect('/employee'); 
        return redirect()->back();
    }

    public function batchInsert($tableObject,$data){

        $data=json_decode($data,true);
        if(!empty($data[0])){
            $tableObject->createMany($data);
        }

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

public function getAllEmployees(DatatableHelper $databaseHelper){
    $employees = EmployeeMaster::with('employee_series','employee_job_info.department.branch','employee_job_info.designation'); 
        // dd($employees);
    return Datatables::of($employees)
    ->addColumn('action', function ($employees) use ($databaseHelper){
        return $databaseHelper->editButton('employee',$employees->id).' '.$databaseHelper->deleteButton($employees->id);
    })
    ->make(true);
}

}
