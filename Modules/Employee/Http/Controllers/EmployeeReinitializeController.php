<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\EmployeeMaster;
use Modules\Employee\Entities\EmployeeJobInfo;
use Modules\Employee\Entities\EmployeeSalaryInformation;
use Modules\Employee\Entities\EmployeeWorkHistoryInCompany; 
use Modules\Organization\Entities\Department; 
use Modules\Organization\Entities\Branch; 
use Modules\Organization\Entities\Designation; 

use Datatables; 
use DB;
use URL;
use \Modules\Helpers\DatatableHelper;
use Validator; 
class EmployeeReinitializeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('employee::employee_reinitialize.employee_reinitialize');
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

    public function store(\Modules\Employee\Http\Requests\EmployeeReInitializeRequest $request)
    {   

     $employee_job_info=EmployeeJobInfo::where('employees_master_id','=',$request->employees_master_id)->get();

     $data['date']=date('Y-m-d');
     $data['remarks']="Reinitialized in Branch : ".Branch::find($request->department_branch_id)->first()->branch_name.", Department: ".Department::find($request->department_id)->first()->department_name." as ".Designation::find($request->designation_id)->first()->designation_name.


     $employee_job_info[0]->update(['relieving_date'=>NULL]);
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
