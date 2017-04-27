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
        return view('organization::holiday.holiday');
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
    public function store(Request $request){ 
        $week_holiday_master=WeekHolidayMaster::create($request->all()); 
        foreach ($request->checked_days as $key => $value) {
           WeekHoliday::create([
            'day_name_id'=>intval($value),
            'week_holiday_master_id'=>$week_holiday_master->id
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
    public function edit(WeekHolidayMaster $week_holiday_master)
    {            
        // dd($week_holiday_master->week_holiday);
     return view('organization::week_holiday.edit_week_holiday',
        [
        'week_holiday_master'=>$week_holiday_master,
        'day_names'=>DayName::all()  
        ]);
 }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,WeekHolidayMaster $week_holiday_master)
    {   
     DB::table('week_holiday')->where('week_holiday_master_id', $week_holiday_master->id)->delete();

     $week_holiday_master->update($request->all()); 
     foreach ($request->checked_days as $key => $value) {
       WeekHoliday::create([
        'day_name_id'=>intval($value),
        'week_holiday_master_id'=>$week_holiday_master->id
        ]);
   }

   $request->session()->flash('status', 'Task was successful!');
   return redirect('/week_holiday');
}

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, WeekHolidayMaster $week_holiday_master)
    { 
        $week_holiday_master->delete();
        $request->session()->flash('status', 'Task was successful!'); 
    }

    public function getAllWeekHolidays(DatatableHelper $databaseHelper)
    { 

        $week_holiday_master = WeekHolidayMaster::with('week_holiday')->select('*');
        return Datatables::of($week_holiday_master)
        ->addColumn('days', function ($week_holiday_master) {
            return $week_holiday_master->week_holiday->map(function($week_holiday) {
                return $week_holiday->day_name->dayname;
            })->implode(', ');
        })
        ->addColumn('action', function ($week_holiday_master) use ($databaseHelper){
            return $databaseHelper->editButton('week_holiday',$week_holiday_master->id).' '.$databaseHelper->deleteButton($week_holiday_master->id);
        })
        ->make(true);

    }    
}
