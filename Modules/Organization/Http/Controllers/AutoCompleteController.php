<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 
use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\Branch;
use Modules\Organization\Entities\District;
use Modules\Organization\Entities\PostOffice;
use Modules\Organization\Entities\BranchType; 
use Modules\Organization\Entities\DepartmentType; 
use Modules\Organization\Entities\Department; 
class AutoCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { 
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
    
    public function getBranchTypes(Request $request, BranchRepository $branchRepository){
        return $branchRepository->getAllBranchTypes('branch_type_name', $request->input('term'), ['id', 'branch_type_name as text']); 
    }
    public function getBranchs(Request $request, BranchRepository $branchRepository){
        return $branchRepository->getAllBranchs('branch_name', $request->input('term'), ['id', 'branch_name as text']); 
    }


    public function getDistricts(Request $request, BranchRepository $branchRepository){
        return $branchRepository->getAllDistricts('district_name', $request->input('term'), ['id', 'district_name as text']); 
    }    

    public function getDepartmentTypes(Request $request, BranchRepository $branchRepository){
        return $branchRepository->getAllDepartmentTypes('department_type_name', $request->input('term'), ['id', 'department_type_name as text']); 
    }    
    public function getDesignations(Request $request, BranchRepository $branchRepository){ 
        return $branchRepository->getDesignations('designation_name', $request->input('term'),['id','designation_name as text']); 
    }    

    public function getPostOffices(Request $request, BranchRepository $branchRepository){ 
        return $branchRepository->getPostOffices('post_office_name', $request->input('term'),$request->input('value_term'), ['id', 'post_office_name as text']); 
    }
    public function getSalaryHead(Request $request, BranchRepository $branchRepository){ 
        return $branchRepository->getSalaryHeads('salary_head_name', $request->input('term'),$request->input('value_term'), ['id', 'salary_head_name as text']); 
    }

    public function getDistrictOfBranch(Request $request)
    {  
        $branch_id = $request->input('branch_id');
        $district = Branch::with(['district'=> function($query){
            $query->select('id', 'district_name as text'); 
        }])
        ->find($branch_id)->district;
        return response()->json($district);

    }

    public function getDistrictOfPostOffice(Request $request)
    {  
        $post_office_id = $request->input('post_office');
        $district = PostOffice::with(['district'=> function($query){
            $query->select('id', 'district_name as text'); 
        }])
        ->find($post_office_id)->district;
        return response()->json($district);

    }

    public function getPostOfficeOfBranch(Request $request)
    {  
        $branch_id = $request->input('branch_id');
        $post_office = Branch::with(['post_office'=> function($query){
            $query->select('id', 'post_office_name as text'); 
        }])
        ->find($branch_id)->post_office;
        return response()->json($post_office);

    }
    public function getBranchTypeOfBranch(Request $request)
    {  
        $branch_id = $request->input('branch_id');
        $branch_type = Branch::with(['branch_type'=> function($query){
            $query->select('id', 'branch_type_name as text'); 
        }])
        ->find($branch_id)->branch_type;
        return response()->json($branch_type);
    }
    public function getDepartmentTypeOfDepartment(Request $request)
    {  
        $department_id = $request->input('department_id');
        $department_type = Department::with(['department_type'=> function($query){
            $query->select('id', 'department_type_name as text'); 
        }])
        ->find($department_id)->department_type;
        return response()->json($department_type);
    }
    public function getBranchOfDepartment(Request $request)
    {  
        $department_id = $request->input('department_id');
        $branch = Department::with(['branch'=> function($query){
            $query->select('id', 'branch_name as text'); 
        }])
        ->find($department_id)->branch;
        return response()->json($branch);
    }

    public function getDepartmentOfBranch(Request $request)
    {   
        $branch_id = intval($request->input('value_term')); 
 
        $departments = Department::where('branch_id','=',$branch_id)->get(array('id','department_name as text'));        
        return response()->json($departments);
    }

    public function returnTestJson(Request $request)
    {  
        return json_encode(['label'=>'sada','value'=>10]);
    }





}

