<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest:seller', ['except' => ['logout']]);
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $redirectUrl = "/seller/dashboard";

        dd($request);


        // checking users type here in loop
        foreach (Auth::guard('seller')->user()->role as $roles) {
            if ($roles->name == 'CEO') {
                $this->redirectTo = $redirectUrl;
                return redirect($redirectUrl);
            } elseif ($roles->name == 'AreaManager') {
                $this->redirectTo = $redirectUrl;
                return redirect($redirectUrl);
            } elseif ($roles->name == 'Manager') {
                $this->redirectTo = $redirectUrl;
                return redirect($redirectUrl);
            } elseif ($roles->name == 'Clerk') {
                $this->redirectTo = $redirectUrl;
                return redirect($redirectUrl);
            }
        }
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('sellers.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('seller');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @copy from AuthenticateUser for logging out from seller route
     */
    public function logout()
    {
        Auth::guard('seller')->logout();
        return redirect('/seller');
    }
}
