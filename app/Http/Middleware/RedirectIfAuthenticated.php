<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {

                    $status="";
                    // checking users type here in loop
                    foreach(Auth::guard('admin')->user()->role as $roles){

                        if($roles->name == 'Superadmin'){

                            if(session('status')){
                                $status = session('status');
                            }
                            return redirect('/admin/superadmin-dashboard')->with('status',$status);

                        }else if($roles->name == 'Admin'){

                            if(session('status')){
                                $status = session('status');
                            }
                            return redirect('/admin/admin-dashboard')->with('status',$status);

                        }else if($roles->name == 'Editor'){

                            if(session('status')){
                                $status = session('status');
                            }
                            return redirect('/admin/editor-dashboard')->with('status',$status);

                        }else if($roles->name == 'Moderator'){

                            if(session('status')){
                                $status = session('status');
                            }
                            return redirect('/admin/moderator-dashboard')->with('status',$status);
                        }
                    }
                    //return redirect('admin/home');
                }
                break;
                   
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }       
        

        return $next($request);
    }
}
