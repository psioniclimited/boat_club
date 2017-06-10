<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Employee\Entities\EmployeeMaster; 
use Modules\Employee\Entities\EmployeeJobInfo; 
use Modules\Employee\Entities\EmployeeWorkHistoryInCompany; 
use Modules\Organization\Entities\Branch; 
use Modules\Organization\Entities\Department; 
use \Modules\Helpers\DatatableHelper;
use Datatables;

class EmployeeTransferAndPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('employee::employee_transfer_and_promotion.employee_transfer_and_promotion');
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
     */
    public function store(\Modules\Employee\Http\Requests\EmployeeTransferRequest $request){  

       $employee_job_info=EmployeeJobInfo::where('employees_master_id','=',$request->employees_master_id)->get();

       $data=$request->all();
       $data['date']=date('Y-m-d');

       if($request->action_type==1){ 
        $data['remarks']="transfered from Branch : ".$employee_job_info[0]->branch->branch_name.", Department: ".$employee_job_info[0]->department->department_name." to Branch: ".Branch::find($request->department_branch_id)->first()->branch_name.", Department: ".Department::find($request->department_id)->first()->department_name;
    }else{
        $data['remarks']="Promoted from Branch : ".$employee_job_info[0]->branch->branch_name.", Department: ".$employee_job_info[0]->department->department_name.", Designation: ".$employee_job_info[0]->designation->designation_name." to Branch: ".Branch::find($request->department_branch_id)->first()->branch_name.", Department: ".Department::find($request->department_id)->first()->department_name.", Designation: ".$employee_job_info[0]->designation->designation_name;
    }


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
    public function edit()
    {        

    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update()
    { 
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {  
    }

    public function getAllOfferLetters(DatatableHelper $databaseHelper)
    {  
    }    
}
