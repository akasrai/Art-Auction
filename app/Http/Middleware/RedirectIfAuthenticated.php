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
                    $redirectUrl = "/admin/dashboard";
                    // checking users type here in loop
                    foreach (Auth::guard('admin')->user()->role as $roles) {
                        if ($roles->name == 'Superadmin') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        } elseif ($roles->name == 'Admin') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        } elseif ($roles->name == 'Editor') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        } elseif ($roles->name == 'Moderator') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        }
                    }
                    //return redirect('admin/home');
                }
                break;

            case 'seller':
                if (Auth::guard($guard)->check()) {
                    $status="";
                    $redirectUrl = "/admin/dashboard";

                    foreach (Auth::guard('seller')->user()->role as $roles) {
                        dump($roles->name);
                        if ($roles->name == 'CEO') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        } elseif ($roles->name == 'AreaManager') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        } elseif ($roles->name == 'Manager') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        } elseif ($roles->name == 'Clerk') {
                            if (session('status')) {
                                $status = session('status');
                            }
                            return redirect($redirectUrl)->with('status', $status);
                        }
                    }

                }

                   
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/home');
                }
                break;
        }
        return $next($request);
    }
}
