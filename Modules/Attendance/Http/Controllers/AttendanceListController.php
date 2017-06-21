<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Attendance\Entities\AttendanceLog; 
use DB;

use Datatables;   
use \Modules\Helpers\DatatableHelper;

class AttendanceListController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
        return view('attendance::attendance.attendance_list');
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('attendance::create');
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
        return view('attendance::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('attendance::edit');
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


    public function getAttendanceLog(Request $request,DatatableHelper $databaseHelper){ 

        $data = DB::table('employees_master')
        ->select('employees_master.employee_fullname','employees_master.employee_code','attendance_log.punch_in_time','attendance_log.punch_out_time','branch.branch_name','department.department_name','designation.designation_name') 
        ->join('employee_job_info', function($query) use ($request){
            $query->on( 'employee_job_info.employees_master_id', '=', 'employees_master.id'); 
            $query->where('employee_job_info.department_branch_id', '=', $request->department_branch_id);
            if ( $request->department_id!=null) {
                $query->where('employee_job_info.department_id', '=', $request->department_id);
            }
        })
        ->join('attendance_log', function($query) use ($request){
            $query->on('attendance_log.employees_master_id', '=', 'employees_master.id');
            $query->where('attendance_log.working_date', '=', $request->working_date);
        })   
        ->join('branch', 'employee_job_info.department_branch_id', '=', 'branch.id') 
        ->join('department', 'employee_job_info.department_id', '=', 'department.id') 
        ->join('designation', 'employee_job_info.designation_id', '=', 'designation.id')  
        ->where('employees_master.employee_status','=',1 ) 
        ->orderBy('employees_master.employee_fullname', 'ASC') 
        ->get();

        // return response()->json($data);
        // $data = AttendanceLog::with('employees_master','employees_master.employee_job_info.department.branch','employees_master.employee_job_info.designation');  
        
        return Datatables::of($data) 
        ->make(true);

    }
}
