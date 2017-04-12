<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Form;
use Auth;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Datatables;
use URL;
use Input;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::login');
    }

    public function login(Request $request){
        $credentials=array('email' => $request->email,  'password' => $request->password);
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->withInput();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::all(); 
        return view('user::create_users',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(\Modules\User\Http\Requests\UserRequest $request)
    {  
        $user = User::create($request->all());
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->roles()->sync($request->input('role')); 
        return back();
    }
    /**
     * returns a list of all users 
     */
    public function showAllUsers()
    {  
        return view('user::all_users');
    }

    /**
     * returns a list for the datatable
     */
    public function getUsers()
    {
        $users = User::all(); 
        return Datatables::of($users)
        ->addColumn('action', function ($users) {
            return '<a href="'.URL::to('/').'/user/'.$users->id.'/edit" class="btn btn-sm btn-info" title="edit"><i class="glyphicon glyphicon-edit"></i></a>';
        })
        ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(User $user)
    {
        // return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::all(); 
        return view('user::create_users',['user'=>$user,'roles'=>$roles]);
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
}
