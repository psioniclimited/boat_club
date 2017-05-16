<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository; 
use Modules\Organization\Entities\Holiday;   
use Modules\Organization\Entities\HolidayList;   
use \Modules\Helpers\DatatableHelper;
use Datatables;
use DB;
use Validator;
class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // return view('organization::holiday.holiday_list');

        return view('organization::holiday.create_holiday_new');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // return view('organization::holiday.create_holiday');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\Organization\Http\Requests\HolidayListCreateRequest $request){ 
        HolidayList::create($request->all());
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
    public function edit($id)
    {             
        $holliday_list=HolidayList::find($id)->get(); 
        return view('organization::holiday.edit_holiday_new',['holiday_list'=>$holliday_list[0]]);
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




    public function getAllHolidayLists(DatatableHelper $databaseHelper)
    { 

        $holidayList = HolidayList::all();
        return Datatables::of($holidayList)
        ->addColumn('action', function ($holidayList) use ($databaseHelper){
            return $databaseHelper->editButton('holiday',$holidayList->id).' '.$databaseHelper->deleteButton($holidayList->id);
        })
        ->make(true);

    }    





    public function storeHolidayInfo(\Modules\Organization\Http\Requests\HolidayListCreateRequest $request)
    {    
        // dd($request->all());
        foreach (json_decode($request->data,true) as $row) {  
            if(!$this->validateGradeInfoData($row)){
                $request->session()->flash('alert-class', 'Could not save data!');
                return response()->json(['link'=>'/holiday']);
            }
        } 
 
        $holiday_list=HolidayList::find($request->holiday_list_id);
        $holiday_list->update($request->all());
        $holiday_list->holiday()->delete();
        $holiday_list->holiday()->createMany(json_decode($request->data,true));

        $request->session()->flash('status', 'Task was successful!');
        return response()->json(['link'=>'/holiday']);
    }


    public function validateGradeInfoData($data){

        // dd($data);
     $validator = Validator::make($data, array(
        'holiday_name' =>'required' , 
        'holiday_date' =>'required',   
        ));

        if ($validator->fails())
        { 
            // dd("salkd");
            return false;
        }
        return true;
    }

    public function holidayDetails($id){ 
        $holiday_infos = HolidayList::find($id)->holiday;
        return response()->json($holiday_infos);
    }

 






}
