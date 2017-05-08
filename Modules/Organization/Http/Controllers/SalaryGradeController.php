<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository; 
use Modules\Organization\Entities\SalaryGradeMaster;  
use Modules\Organization\Entities\SalaryGradeInfo;  
use Modules\Organization\Entities\SalaryHead;  
use \Modules\Helpers\DatatableHelper;
use Datatables; 
class SalaryGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
        return view('organization::salary_grade.salary_grade');   
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
    public function store(\Modules\Organization\Http\Requests\SalaryGradeCreateRequest $request){

        $salary_grade_master=SalaryGradeMaster::create($request->all());

        if(isset($request->submit_and_edit)){ 
            $this->edit($salary_grade_master);
        }

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
    public function edit(SalaryGradeMaster $salary_grade_master) {
     return view('organization::salary_grade.edit_salary_grade',['salary_grade_master'=>$salary_grade_master]);
 }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\SalaryHeadCreateRequest $request, SalaryGradeMaster $salary_grade_master)
    {
        // $salary_head->update($request->all());
        // $request->session()->flash('status', 'Task was successful!');
        // return redirect('/salary_head');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, SalaryGradeMaster $salary_grade_master)
    { 
        // $salary_head->delete();
        // $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllSalaryGrades(DatatableHelper $databaseHelper)
    { 
        $salary_grades = SalaryGradeMaster::all(); 

        return Datatables::of($salary_grades)
        ->addColumn('action', function ($salary_grades) use ($databaseHelper){
            return $databaseHelper->editButton('salary_grade',$salary_grades->id).' '.$databaseHelper->deleteButton($salary_grades->id);
        })
        ->make(true);
    }

    public function gradeInfo(Request $request)
    {  
        $salary_grade_infos = SalaryGradeMaster::find($request->salary_grade_master_id)->salary_grade_info;
        return response()->json($salary_grade_infos);
    }

    public function createNewGradeInfo(Request $request)
    {  
        // dd($request->all()['data'][0]);
        $salary_grade_info = SalaryGradeInfo::create($request->all()['data'][0]);
        $salary_grade_info->DT_RowId = "row_" . $salary_grade_info->id;
        return response()->json($salary_grade_info);

    }
    public function storeGradeInfo(Request $request)
    {   
        // dd();
        $salary_grade_master=SalaryGradeMaster::find($request->salary_grade_master_id);
        $salary_grade_master->salary_grade_info()->createMany(json_decode($request->data,true));
    }

    public function salaryGradeInfo($salary_grade_master_id)
    {   
        $salary_grade_infos = SalaryGradeMaster::find(intval($salary_grade_master_id))->salary_grade_info; 
        return response()->json($salary_grade_infos);
    }

}
