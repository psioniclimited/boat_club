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


    public function getDistricts(Request $request, BranchRepository $branchRepository){
        return $branchRepository->getAllDistricts('district_name', $request->input('term'), ['id', 'district_name as text']); 
    }    

    public function getPostOffices(Request $request, BranchRepository $branchRepository){ 
        return $branchRepository->getPostOffices('post_office_name', $request->input('term'),$request->input('value_term'), ['id', 'post_office_name as text']); 
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





}

