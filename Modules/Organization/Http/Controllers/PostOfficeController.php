<?php

namespace Modules\Organization\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Organization\Repositories\BranchRepository;
use Modules\Organization\Entities\District;  
use Modules\Organization\Entities\PostOffice;
use \Modules\Helpers\DatatableHelper;
use Datatables;
class PostOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('organization::post_office.post_office');
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
    public function store(\Modules\Organization\Http\Requests\PostOfficeCreateRequet $request)
    { 
     $user = PostOffice::create($request->all());  
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
    public function edit(PostOffice $post_office)
    {  
        return view('organization::post_office.edit_post_office',
            [
            'post_office'=>$post_office
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\Organization\Http\Requests\PostOfficeCreateRequet $request,PostOffice $post_office)
    {
        $post_office->update($request->all());
        $request->session()->flash('status', 'Task was successful!');
        return redirect('/post_office');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request, PostOffice $post_office)
    { 
        // dd($district);
        $post_office->delete();
        $request->session()->flash('status', 'Task was successful!');
        // return back(); 
    }
    


    public function getAllPostOffices(DatatableHelper $databaseHelper)
    { 
        $post_offices = PostOffice::with('district'); 

        return Datatables::of($post_offices)
        ->addColumn('action', function ($post_offices) use ($databaseHelper){
            return $databaseHelper->editButton('post_office',$post_offices->id).' '.$databaseHelper->deleteButton($post_offices->id);
        })
        ->make(true);
    }



}

