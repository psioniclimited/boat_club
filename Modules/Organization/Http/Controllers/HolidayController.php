<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository; 
use Modules\Organization\Entities\Holiday;   
use \Modules\Helpers\DatatableHelper;
use Datatables;
use DB;
class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::holiday.holiday_list');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('organization::holiday.create_holiday');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Organization\Http\Requests\HolidayCreateRequest $request){ 
        $holiday=Holiday::create($request->all());
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
    public function edit(Holiday $holiday)
    {             
       return view('organization::holiday.edit_holiday',['holiday'=>$holiday ]);
   }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,Holiday $holiday)
    {    
        $holiday->update($request->all());  
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/holiday');
 }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, Holiday $holiday)
    { 
        $holiday->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllHolidays(DatatableHelper $databaseHelper)
    { 

        $holiday = Holiday::all();
        return Datatables::of($holiday)
        ->addColumn('action', function ($holiday) use ($databaseHelper){
            return $databaseHelper->editButton('holiday',$holiday->id).' '.$databaseHelper->deleteButton($holiday->id);
        })
        ->make(true);

    }    
}
