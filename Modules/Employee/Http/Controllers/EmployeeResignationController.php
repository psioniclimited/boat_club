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
use DB;
use URL;
use \Modules\Helpers\DatatableHelper;
use Validator; 
class EmployeeResignationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('employee::employee_resignation.employee_resignation');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    { 

    }


    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     * there are two steps of validation on this method
     * the first step validation EmployeeCreateRequest checks the single form elements
     * the second level validation checks the redundant elements that is the table data 
     */

    public function store(\Modules\Employee\Http\Requests\EmployeeResignationRequest $request)
    {   

     $employee_job_info=EmployeeJobInfo::where('employees_master_id','=',$request->employees_master_id)->get();

     $data=$request->all();
     $data['date']=date('Y-m-d');
     $data['remarks']="Resigned";

     $data['department_branch_id']=$employee_job_info[0]->department_branch_id;
     $data['department_id']=$employee_job_info[0]->department_id;
     $data['designation_id']=$employee_job_info[0]->designation_id;

     $employee_job_info[0]->update(['re_joining_date'=>NULL]);
     $employee_job_info[0]->update($request->all());
     
     EmployeeWorkHistoryInCompany::create($data);  
     $request->session()->flash('status', 'Task was successful!');
     return back();
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
    public function destroy(Request $request, EmployeeMaster $employee)
    {  
    }




}
