<?php

namespace App\Http\Controllers\Myadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('superadmins' || 'editor' || 'admins' || 'moderator');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        foreach (Auth::guard('admin')->user()->role as $roles) {
            if ($roles->name == 'Superadmin') {
                return $this->renderSuperAdminDashboard();
            } elseif ($roles->name == 'Admin') {
                return $this->renderAdminDashboard();
            } elseif ($roles->name == 'Editor') {
                return $this->renderEditorDashboard();
            } elseif ($roles->name == 'Moderator') {
                return $this->renderModeratorDashboard();
            }
        }
    }

    private function renderSuperAdminDashboard()
    {
        return view('myadmin/superadmin_dashboard');
    }

    private function renderAdminDashboard()
    {
        return view('myadmin/admin_dashboard');
    }

    private function renderEditorDashboard()
    {
        return view('myadmin/editor_dashboard');
    }

    private function renderModeratorDashboard()
    {
        return view('myadmin/moderator_dashboard');
    }
}
