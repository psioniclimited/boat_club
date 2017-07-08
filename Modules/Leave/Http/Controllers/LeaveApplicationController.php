<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use Modules\Leave\Entities\LeaveLedger;
use Modules\Leave\Entities\LeaveStatus;
use \Modules\Helpers\DatatableHelper;
use Datatables;


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
    public function edit(AttendanceDeductionMaster $attendance_deduction)
    {  
        return view('organization::attendance_deduction.edit_attendance_deduction',['attendance_deduction'=>$attendance_deduction]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\AttendanceDeductionUpdateRequest $request,AttendanceDeductionMaster $attendance_deduction)
    {
        $attendance_deduction->update($request->all()); 
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/attendance_deduction');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(AttendanceDeductionMaster $attendance_deduction,Request $request)
    { 
        // dd($attendance_deduction);
        $attendance_deduction->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back();
    }
    


    public function getAllLeaveApplications(DatatableHelper $databaseHelper)
    { 
        $leave_applications = LeaveLedger::with('employees_master.employee_job_info.branch', 'employees_master.employee_job_info.department','employees_master.employee_job_info.designation','leave_status'); 
 
        return Datatables::of($leave_applications)
        ->addColumn('action', function ($leave_applications) use ($databaseHelper){
            return $databaseHelper->editButton('leave_application',$leave_applications->id).' '.$databaseHelper->deleteButton($leave_applications->id);
        })
        ->make(true);
    }



}

