<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Role;
use App\User;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $role=Role::get();
        $user=User::get();

        return view('admin/role',array('role' => $role));
    }

    public function register(Request $request)
    {     
   
       return Validator::make($request->all(), ['role_name' => 'required'])->validate();

    
          $role=Role::create([
            'role_name' => $request['role_name']
        ]);
        // return redirect('role');

    }    
}
