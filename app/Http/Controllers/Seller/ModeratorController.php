<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeratorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin'); // for admin authentication
        $this->middleware('moderator', ['except'=>'test']); //for role access and the function mentioned in except do not obey the moderator middleware
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('myadmin/dashboard/moderator_dashboard');
    }


    public function test()
    {
        return view('myadmin.test');
    }
}
