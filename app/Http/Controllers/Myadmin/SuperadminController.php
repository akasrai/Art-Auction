<?php

namespace App\Http\Controllers\Myadmin;

use DB;
use App\Admin;
use App\Role;
use App\Role_admin;
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
        $this->middleware('auth:admin'); // for admin authentication
        $this->middleware('superadmins'); //for role access
    }

    public function userlist(){

       // $users = Admin::orderBy('created_at','desc')->paginate(10);
       
        $users = DB::table('admins')
                ->join('role_admins', 'role_admins.admin_id', '=', 'admins.id')
                ->join('roles', 'roles.id', '=', 'role_admins.role_id')
                //->where('follows.follower_id', '=', 3)
                ->select('admins.*', 'roles.name')
                ->orderBy('admins.created_at','desc')->paginate(10);
                //->get();
        
        
        return view('myadmin/userlist')->with('users',$users);
    }

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('myadmin/superadmin_dashboard');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleArticle($id)
    {
        return view('myadmin/single-article')->with('id',$id);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
