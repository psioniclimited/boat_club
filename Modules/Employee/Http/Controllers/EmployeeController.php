<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\EmployeeMaster;
use Modules\Employee\Entities\EmployeeJobInfo;
use Modules\Employee\Entities\EmployeeSalaryInformation;
use Modules\Employee\Entities\EmployeeWorkHistoryInCompany;
use Modules\Employee\Entities\EmployeeSeries;
use Modules\Employee\Entities\EmploymentType;
use Modules\Employee\Entities\PaymentMode;
use Modules\Employee\Entities\Salutation;
use Modules\Employee\Entities\MaritalStatus;
use Modules\Employee\Entities\Religion;
use Modules\Employee\Entities\BloodGroup;
use Modules\Employee\Entities\EmployeeSalaryDetails;
use Modules\Employee\Entities\EmployeeEducationalBackground;
use Modules\Employee\Entities\EmployeePreviousJobExperience; 
use Modules\Employee\Entities\EmployeeFamilyMembers; 
use Modules\Organization\Entities\SalaryHead;
use Modules\Organization\Entities\LeavePackage;

use Modules\Leave\Entities\LeaveStock;


use Datatables; 
use DB;
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

      return view('employee::employee.create_employee',[
        'salutations'=>Salutation::all(),
        'employee_serieses'=>EmployeeSeries::all(),
        'employment_types'=>EmploymentType::all(),
        'payment_modes'=>PaymentMode::all(),
        'marital_statuses'=>MaritalStatus::all(),
        'religions'=>Religion::all(),
        'blood_groups'=>BloodGroup::all(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     * there are two steps of validation on this method
     * the first step validation EmployeeCreateRequest checks the single form elements
     * the second level validation checks the redundant elements that is the table data 
     */

    // public function store(Request $request)
    public function store(\Modules\Employee\Http\Requests\EmployeeCreateRequest $request)
    {    
      // dd($request->leave_package_id);
      $tableValidation=$this->validateTableData($request);
      if($tableValidation[0]==false){ 
        return response()->json(['error' => $tableValidation[1]]); 
      }

      $employees_master=EmployeeMaster::create($request->all());
      $this->createAdditionalData($employees_master,$request,1);
        // dd($employees_master->id); 


      return response()->json(['redirect' => URL::to('/employee')], 200);
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
      if($data!=[]){
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
    public function edit(EmployeeMaster $employee)
    {
        // dd();
      return view('employee::employee.edit_employee',['employee'=>$employee,
        'salutations'=>Salutation::all(),
        'employee_serieses'=>EmployeeSeries::all(),
        'employment_types'=>EmploymentType::all(),
        'payment_modes'=>PaymentMode::all(),
        'marital_statuses'=>MaritalStatus::all(),
        'religions'=>Religion::all(),
        'blood_groups'=>BloodGroup::all()
        ]);
    }



    public function deleteAdditionalData($employee){

     $employee->employee_family_members()->delete();
     $employee->employee_work_history_inside_company()->delete();
     $employee->employee_educational_background()->delete();
     $employee->employee_previous_job_experience()->delete();


     $employee_job_info=$employee->employee_job_info;

     $cached_leave_package_id= $employee_job_info[0]->leave_package_id;

     $employee_salary_info=$employee_job_info[0]->employee_salary_information;

     $employee_salary_info[0]->employee_salary_details()->delete();
     $employee_salary_info[0]->delete();
     $employee_job_info[0]->delete();

     return $cached_leave_package_id;

   }
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Employee\Http\Requests\EmployeeCreateRequest $request,EmployeeMaster $employee)
    {  
        // dd($request->salary_details);
      $tableValidation=$this->validateTableData($request);
      if($tableValidation[0]==false){ 
        return response()->json(['error' => $tableValidation[1]]); 
      }

      $employee->update($request->all()); 
      $cached_leave_package_id=$this->deleteAdditionalData($employee);

      $this->createAdditionalData($employee,$request,2,$cached_leave_package_id);
      return response()->json(['redirect' => URL::to('/employee')], 200);
    }

/*
* mode 1 =for create
* mode 2 =for update
*/
public function createAdditionalData($employees_master,$request,$mode,$cached_leave_package_id=null){
  $data=$request->all(); 

  $data['employees_master_id']=$employees_master->id;
  $employee_job_info=EmployeeJobInfo::create($data);

  $data['employee_job_info_id']=$employee_job_info->id;
  $employee_salary_info=EmployeeSalaryInformation::create($data);

  if($mode==1){  
    //generate the designated leave package for this employee
  
    $this->generateLeaveStock($employees_master,LeavePackage::find($request->leave_package_id));

    $data['remarks']="Joined the Organization";
    EmployeeWorkHistoryInCompany::create($data);
  }

  
  //on update if new leave package id dieers from previous on then update leave stock for this employee 
  
  if ($mode==2 && $cached_leave_package_id!=null && $cached_leave_package_id!=$request->leave_package_id) { 
     $employees_master->leave_stock()->delete();
     $this->generateLeaveStock($employees_master,LeavePackage::find($request->leave_package_id));
  }

  $employee_salary_info->employee_salary_details()->createMany(json_decode($request->salary_details,true));

  $this->batchInsert($employees_master->employee_family_members(),$request->family_information);

  $this->batchInsert($employees_master->employee_educational_background(),$request->educational_background);

  $this->batchInsert($employees_master->employee_previous_job_experience(),$request->previous_work_history);

  $this->batchInsert($employees_master->employee_work_history_inside_company(),$request->history_inside_organization);


}


public function generateLeaveStock($employees_master,$leave_package)
{
  $package_details=$leave_package->leave_package_details;
  foreach ($package_details as $row) { 
    LeaveStock::create([
      'employees_master_id'=>$employees_master->id,
      'leave_type_id'=>$row->leave_type_id,
      'number_of_days'=>$row->number_of_days,
      ]); 
  }
}



    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, EmployeeMaster $employee)
    {
     $employee->delete();
     $request->session()->flash('status', 'Task was successful!');  
   }

   public function checkUniqueEmployeeCode(Request $request)
   {  

    $employee_code=$request->employee_code;
    $flight = EmployeeMaster::where('employee_code', $employee_code)->first();
    if (empty($flight)) {
      return response()->json(false);
    }else{
      return response()->json(true);
    }

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

  public function getAmountOfSalaryHead(Request $request){ 
    $data=EmployeeSalaryDetails::where('employee_salary_information_id','=',$request->employee_salary_info_id)
    ->where('salary_head_id','=',$request->salary_head_id)
    ->get(); 
    if (!empty($data) && ($data[0]->amount!="" || $data[0]->amount!=NULL )) {
      return response()->json($data[0]->amount);
    }else{
      return response()->json(0);
    }
  }

  public function getSalaryHeadsWithAmount(Request $request){ 
    $data=SalaryHead::leftJoin('employee_salary_details','salary_head.id','=','employee_salary_details.salary_head_id')
    ->join('salary_head_type','salary_head.salary_head_type_id','=','salary_head_type.id')
    ->select(['*'])
    ->where('employee_salary_details.employee_salary_information_id','=',$request->employee_salary_info_id)
    ->get();
    return response()->json($data);    
  }


  public function getEmployeeEducations(Request $request){ 

    $data=EmployeeEducationalBackground::where('employees_master_id','=',$request->employees_master_id)
    ->get();
    return response()->json($data);    
  }

  public function getEmployeePreviousHistory(Request $request){ 
    $data=EmployeePreviousJobExperience::where('employees_master_id','=',$request->employees_master_id)
    ->get();
    return response()->json($data);    
  }

  public function getEmployeeHistoryInsideOrganization(Request $request){  
    $data=EmployeeWorkHistoryInCompany::where('employees_master_id','=',$request->employees_master_id)
    ->get();
    return response()->json($data);    
  }

  public function getEmployeeFamilyInformation(Request $request){  
    $data=EmployeeFamilyMembers::where('employees_master_id','=',$request->employees_master_id)
    ->get();
    return response()->json($data);    
  }

}
