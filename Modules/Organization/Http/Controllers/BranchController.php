<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::branch.branch');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('organization::create');
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
        return view('organization::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('organization::edit');
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
}
