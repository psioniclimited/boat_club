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
        // $salary_head_type=SalaryGradeMaster::all();
        // return view('organization::salary_head.salary_head',['salary_head_type'=>$salary_head_type]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {  
        $salary_heads=SalaryHead::all(); 
        return view('organization::salary_grade.create_salary_grade',['salary_heads'=>$salary_heads]);        
        // return view('organization::salary_grade.test',['salary_heads'=>$salary_heads]);        
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Organization\Http\Requests\SalaryGradeCreateRequest $request){
        dd($request->all());
        $salary_grade_master=SalaryGradeMaster::create($request->all());  
        foreach ($request->select as $key => $value) { 
            SalaryGradeInfo::create([
                'salary_head_id'=>intval($value),
                'salary_grade_master_id'=>$salary_grade_master->id,
                'amount'=>$request->amount_.$value,
                ]);
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
    public function edit(SalaryGradeMaster $salary_grade_master, SalaryGradeInfo $salary_grade_info)
    {         
       // return view('organization::salary_head.edit_salary_head',
       //  [
       //  'salary_head'=>$salary_head,
       //  'salary_head_type'=>SalaryHeadType::all()
       //  ]);
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

    public function getAllSalaryHeads(DatatableHelper $databaseHelper)
    { 
        // $salary_head = SalaryHead::with('salary_head_type'); 

        // return Datatables::of($salary_head)
        // ->addColumn('action', function ($salary_head) use ($databaseHelper){
        //     return $databaseHelper->editButton('salary_head',$salary_head->id).' '.$databaseHelper->deleteButton($salary_head->id);
        // })
        // ->make(true);
    }    
}
