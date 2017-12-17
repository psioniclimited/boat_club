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
use Validator;
class SalaryGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
        return view('organization::salary_grade.salary_grade_list');   
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {  
        return view('organization::salary_grade.create_salary_grade');
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
        // dd($request->all());


        

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
        $salary_grade_master->delete();
        $request->session()->flash('status', 'Task was successful!'); 
        // return redirect()->back();
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
    public function storeGradeInfo(\Modules\Organization\Http\Requests\SalaryGradeCreateRequest $request)
    {    
        foreach (json_decode($request->data,true) as $row) {  
            if(!$this->validateGradeInfoData($row)){
                $request->session()->flash('alert-class', 'Could not save data!');
                return response()->json(['link'=>'/salary_grade']);
            }
        } 

        $salary_grade_master=SalaryGradeMaster::find($request->salary_grade_master_id);
        $salary_grade_master->update($request->all());
        $salary_grade_master->salary_grade_info()->delete();
        $salary_grade_master->salary_grade_info()->createMany(json_decode($request->data,true));

        $request->session()->flash('status', 'Task was successful!');
        return response()->json(['link'=>'/salary_grade']);
    }

    public function salaryGradeInfo($salary_grade_master_id)
    {   
        $salary_grade_infos = SalaryGradeInfo::where('salary_grade_master_id','=',intval($salary_grade_master_id))
        ->join('salary_head', 'salary_grade_info.salary_head_id', '=', 'salary_head.id') 
        ->select('salary_grade_info.amount','salary_grade_info.amount_type','salary_head.salary_head_name','salary_grade_info.salary_head_id')
        ->get(); 
        return response()->json($salary_grade_infos);
    }
    public function getBasicSalaryOfSalaryGrade($salary_grade_master_id)
    {   
        $basic_salary = SalaryGradeMaster::where('id','=',intval($salary_grade_master_id))
        ->get(['basic_salary']); 
        return response()->json($basic_salary);
    }

    public function validateGradeInfoData($data){

     $validator = Validator::make($data, array(
        'salary_head_id' =>'required|exists:salary_head,id' , 
        'amount_type' =>'required|numeric' , 
        'amount' =>'required|numeric' , 
        'salary_grade_master_id' =>'required|exists:salary_grade_master,id' , 
        ));

     if ($validator->fails())
     { 
        return false;
    }
    return true;
}

}
