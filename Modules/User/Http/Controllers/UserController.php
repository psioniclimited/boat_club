<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Form;
use Auth;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Entities\RoleUser;
use Datatables;
use URL;
use DB; 
use Illuminate\Foundation\Validation\ValidatesRequests;
use \Modules\Helpers\DatatableHelper;
class UserController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::login');
    }

    public function login(Request $request){
        // $credentials=array('email' => $request->email,  'password' => $request->password);
        // dd($credentials);
        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended('/');
        // }

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
        $user = User::create([
            
        ]);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $user->roles()->sync($request->input('role')); 
        $request->session()->flash('status', 'Task was successful!');
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
    public function getUsers(DatatableHelper $databaseHelper)
    {
        // dd($databaseHelper->editButton(1));
        $users = User::all(); 
        return Datatables::of($users)
        ->addColumn('action', function ($users) use ($databaseHelper){
            return $databaseHelper->editButton('user',$users->id).' '.$databaseHelper->deleteButton($users->id);
        })
        ->make(true);
    }
    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(User $user)
    { 

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::all(); 
        return view('user::edit_user',[
            'user'=>$user,
            'roles'=>$roles,
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(\Modules\User\Http\Requests\UserEditRequest $request, User $user){   
        $this->validate($request, [       
             'name'=>'required', 
            'password'=>'confirmed',
            'email' => 'required|unique:users,email,'. $user->id
            ]);
        $user->update($request->all());
        if (isset($user->password)) { 
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        $user->roles()->sync($request->input('role')); 
        $request->session()->flash('status', 'Task was successful!');
        // return back();
        return redirect('/user/create');
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(User $user)
    { 
        $user->delete(); 
    }
}
