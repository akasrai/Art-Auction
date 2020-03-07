<?php

namespace App\Http\Controllers\Seller;

use DB;
use App\Models\Role;
use App\Models\Admin;
use App\Models\RoleAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperadminController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('superadmins');
    }

    public function userlist()
    {

       // $users = Admin::orderBy('created_at','desc')->paginate(10);
       
        $users = DB::table('admins')
                ->join('role_admins', 'role_admins.admin_id', '=', 'admins.id')
                ->join('roles', 'roles.id', '=', 'role_admins.role_id')
                //->where('follows.follower_id', '=', 3)
                ->select('admins.*', 'roles.name')
                ->orderBy('admins.created_at', 'desc')->paginate(10);
        //->get();
        
        
        return view('myadmin/user/userlist')->with('users', $users);
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('myadmin/dashboard/superadmin_dashboard');
    }
}
