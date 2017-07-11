<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Leave\Entities\LeaveLedger;
use Modules\Leave\Entities\LeaveStatus;
use Modules\Leave\Entities\LeaveStock;
use \Modules\Helpers\DatatableHelper;
use Datatables;
use DB;
use Redirect;

class LeaveApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('leave::leave_approval.active_leave_application_list');
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
    public function store(Request $request) 
    {     

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('leave::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(LeaveLedger $leave_approval)
    {    
        $remaining_balance=LeaveStock::where('employees_master_id',$leave_approval->employees_master_id)
        ->where('leave_type_id',$leave_approval->leave_type_id)
        ->get();

        return view('leave::leave_approval.edit_active_application',[
            'leave_application'=>$leave_approval,
            'leave_status'=>LeaveStatus::all(),
            'remaining_balance'=>$remaining_balance[0]->number_of_days,
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,LeaveLedger $leave_approval)
    {  
        if (!$this->isActive($leave_approval)) { 
            return redirect()->back()->with('alert-class', 'You can not Change as the leave application is  no longer active');
        }

        $this->updateLeaveStock($leave_approval,LeaveStatus::find($request->leave_status_id));
        
        $leave_approval->update($request->all());


        $request->session()->flash('status', 'Task was successful!');
        return back(); 
    }

    public function isActive($leave_approval)
    { 
        if ($leave_approval->active==1) {
            return true;
        }
        else{
            return false;
        }
    }

    //if leave approved then deduct the working days from the stock
    //otherwise check if the leave was already approved and now been rejected or cancelled in that case we have to add the working days again with the stocks
    public function updateLeaveStock($leave_approval,$new_leave_status)
    {  
        $leave_stock=LeaveStock::where('employees_master_id', $leave_approval->employees_master_id)
        ->where('leave_type_id',  $leave_approval->leave_type_id);
       
        if ($new_leave_status->deduction==1) { 
            $this->addAndUpdateStock($leave_stock,$leave_approval->working_days);
        }else{
            $current_status=LeaveStatus::find($leave_approval->leave_status_id);
            if ($current_status->deduction==1) {
                $this->deductAndUpdateStock($leave_stock,$leave_approval->working_days);
            }
        }

    }

    public function addAndUpdateStock($leave_stock,$working_days){
        $new_days = $leave_stock->get()[0]->number_of_days - $working_days;
        $leave_stock->update(['number_of_days'=>$new_days]);
    }

    public function deductAndUpdateStock($leave_stock,$working_days){
        $new_days = $leave_stock->get()[0]->number_of_days + $working_days;
        $leave_stock->update(['number_of_days'=>$new_days]);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request,LeaveLedger $leave_approval)
    {  

    }
    


    public function getAllLeaveApplications(DatatableHelper $databaseHelper)
    { 
        $leave_applications=DB::table('leave_ledger')
        ->join('employees_master','employees_master.id','=','leave_ledger.employees_master_id')
        ->where('leave_ledger.active', '=', '1')
        ->join('employee_job_info','employee_job_info.employees_master_id','=','employees_master.id')
        ->where('employee_job_info.deleted_at', '=', NULL)
        ->join('department','employee_job_info.department_id','=','department.id')
        ->join('designation','employee_job_info.designation_id','=','designation.id')
        ->join('branch','employee_job_info.department_branch_id','=','branch.id')
        ->join('leave_status','leave_ledger.leave_status_id','=','leave_status.id')
        ->select('leave_ledger.*','employees_master.contact_number','employees_master.employee_fullname','employees_master.employee_code','department.department_name','designation.designation_name','branch.branch_name','leave_status.status_name');

        return Datatables::of($leave_applications)
        ->addColumn('action', function ($leave_applications) use ($databaseHelper){ 
            return $databaseHelper->editButton('leave_approval', $leave_applications->id);
        })
        ->make(true);
    }



}

