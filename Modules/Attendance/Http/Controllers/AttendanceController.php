<?php

namespace Modules\Attendance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Attendance\Entities\AttendanceLog; 
use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
        return view('attendance::attendance.attendance_single');
    }

    public function bulkAttendance()
    { 
        return view('attendance::attendance.attendance_bulk');
    }

        /**
     * Display the punch in view
     * @return Response
     */
        public function punchInIndex()
        {
        // dd("jaks");

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
    public function store(\Modules\Attendance\Http\Requests\AttendanceLogRequest $request)
    {
        $data=$request->all(); 
        // if attendance type is log in then just create new instance of attendance log
        if ($request->attendance_type==1) { 
            $data['punch_in_time']=$request->time;
            AttendanceLog::create($data);
        }else{
            //first check if the user has punched in on that day
            // if yes then update the punch out time of that day
            // else create new instance with punch out time 
            $data['punch_out_time']=$request->time;

            $existing_data=AttendanceLog::where('employees_master_id','=',$data['employees_master_id'])
            ->where('working_date','=',$data['working_date'])
            ->get();

            if (empty($existing_data)) { 
                AttendanceLog::create($data);
            }else{ 
                $existing_data[0]->update($data);
            }
        }

        $request->session()->flash('status', 'Task was successful!');
        return redirect()->back();
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


    public function getEmployees(Request $request)
    {
        // dd($request->all());

        $data = DB::table('employees_master')
        ->select('employees_master.id','employees_master.employee_fullname','employees_master.employee_code')
        ->orderBy('employees_master.employee_fullname', 'ASC')
        ->Join('employee_job_info', 'employee_job_info.employees_master_id', '=', 'employees_master.id') 
        ->where('employees_master.employee_status','=',1 )
        ->where('employee_job_info.department_id','=',$request->department_id ) 
        ->get();

        return response()->json($data);

        // dd($data);
    }

}
