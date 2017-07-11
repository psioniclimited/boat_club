<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Leave\Entities\LeaveLedger;
use Modules\Leave\Entities\LeaveStatus;
use \Modules\Helpers\DatatableHelper;
use Datatables;
use DB;
use Redirect;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('leave::leave_application.list_of_leave_applications');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('leave::leave_application.create_leave_application',['leave_status'=>LeaveStatus::all()]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Leave\Http\Requests\LeaveApplicationCreateRequest $request) 
    {    

        $leave_application = LeaveLedger::create($request->all());
        $leave_application->setWorkingDaysAndPayTypeAttributeManually($request); 
        
        $request->session()->flash('status', 'Task was successful!');
        return back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('organization::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(LeaveLedger $leave_application)
    {  
        // dd("kls");
        return view('leave::leave_application.edit_leave_application',['leave_application'=>$leave_application,'leave_status'=>LeaveStatus::all()]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Leave\Http\Requests\LeaveApplicationCreateRequest $request,LeaveLedger $leave_application)
    { 
        if (!$this->isChangebale($leave_application)) { 
            return redirect()->back()->with('alert-class', 'You can not Change as a Decision has been made on this Application');
        }

        $leave_application->update($request->all());
        $leave_application->setWorkingDaysAndPayTypeAttributeManually($request); 
        
        $request->session()->flash('status', 'Task was successful!');
        return back(); 
    }

    public function isChangebale($leave_application)
    { 
        if ($leave_application->leave_status->change_type==1) {
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request,LeaveLedger $leave_application)
    {  
        // dd($leave_application);

        if (!$this->isChangebale($leave_application)) {  
            $request->session()->flash('alert-class',  'You can not Change as a Decision has been made on this Application');
        } 
        $leave_application->delete();
        $request->session()->flash('status', 'Task was successful!');
 
    }
    
 

    public function getAllLeaveApplications(DatatableHelper $databaseHelper)
    { 
        // $leave_applications = LeaveLedger::with('employees_master.employee_job_info.branch', 'employees_master.employee_job_info.department','employees_master.employee_job_info.designation','leave_status')
        // ->select('leave_ledger.*','employees_master.employee_fullname','employees_master.employee_code','employees_master.employee_job_info.branch.branch_name','employees_master.employee_job_info.department.department_name','employees_master.employee_job_info.designation.designation_name','leave_status.status_name'); 

        // $leave_applications = LeaveLedger::with([
        //     'employees_master.employee_job_info.designation' => function($query){
        //         $query->select('designation_name');
        //     }])
        // $leave_applications = LeaveLedger::with(array('employees_master','employees_master.employee_job_info','employees_master.employee_job_info.designation')); 
        // return response()->json($leave_applications);

        // ->select(['leave_ledger.*']); 
        // return response()->json($leave_applications);
    // dd($leave_applications);



        $leave_applications=DB::table('leave_ledger')
        ->join('employees_master','employees_master.id','=','leave_ledger.employees_master_id')
        ->where('leave_ledger.deleted_at', '=', NULL)
        ->join('employee_job_info','employee_job_info.employees_master_id','=','employees_master.id')
        ->where('employee_job_info.deleted_at', '=', NULL)
        ->join('department','employee_job_info.department_id','=','department.id')
        ->join('designation','employee_job_info.designation_id','=','designation.id')
        ->join('branch','employee_job_info.department_branch_id','=','branch.id')
        ->join('leave_status','leave_ledger.leave_status_id','=','leave_status.id')
        ->select('leave_ledger.*','employees_master.contact_number','employees_master.employee_fullname','employees_master.employee_code','department.department_name','designation.designation_name','branch.branch_name','leave_status.status_name');


        return Datatables::of($leave_applications)
        ->addColumn('action', function ($leave_applications) use ($databaseHelper){
            return $databaseHelper->editButton('leave_application', $leave_applications->id).' '.$databaseHelper->deleteButton($leave_applications->id);
        })
        ->make(true);
    }



}

