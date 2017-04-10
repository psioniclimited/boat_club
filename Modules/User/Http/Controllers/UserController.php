<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Form;
use Auth;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
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

    public function loginUser(Request $request){
        $credentials=array( 'email' => $request->email,  'password' => $request->password);
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return back()->withInput();
    }

    public function createUsers() {
        $getRoles = Role::all(); 
        return view('user::create_users',['getRoles'=>$getRoles]);
    }

    public function createUsersProcess(Request $request) {  
         // dd($request->all());
        $user = User::create();
        $user->password = bcrypt($request->input('password'));
        $user->attachRole($request->input('role'))
        $user = User::find(3);
        $user->attachRole(1);
        dd();
        $addUsers = new User();

        $addUsers->name = $request->input('name');
        $addUsers->email = $request->input('email');
        $addUsers->password = bcrypt($request->input('password'));

        $addUsers->save();

        // $userID = $addUsers->id;
        $roleID = $request->input('roles');
        $addUsers->attachRole($roleID);
        dd('success');
        // $user = User::find($userID);
        $user = User::find(3);
        $role = Role::where('id', '=', $roleID)->get()->first(); 
        $user->attachRole($role); 
        return back();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::create');
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
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('user::edit');
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
