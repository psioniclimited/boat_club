<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\Branch;
use Modules\Organization\Entities\District;  
use \Modules\Helpers\DatatableHelper;
use Datatables;
class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::district.district');
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
    public function store(\Modules\Organization\Http\Requests\DistrictCreateRequet $request)
    { 
       $user = District::create($request->all());  
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
    public function edit(District $district)
    {  
        return view('organization::district.edit_district',
            [
            'district'=>$district
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\DistrictCreateRequet $request,District $district)
    {
        $district->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/district');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, District $district)
    { 
        // dd($district);
        $district->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back(); 
    }
    


    public function getAllDistricts(DatatableHelper $databaseHelper)
    { 
        $districts = District::all(); 

        return Datatables::of($districts)
        ->addColumn('action', function ($districts) use ($databaseHelper){
            return $databaseHelper->editButton('district',$districts->id).' '.$databaseHelper->deleteButton($districts->id);
        })
        ->make(true);
    }



}

