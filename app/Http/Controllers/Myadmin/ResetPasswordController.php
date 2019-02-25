<?php

namespace App\Http\Controllers\Myadmin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
//manual import
use Illuminate\Http\Request;
use Password;
use Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function guard(){
        
        return Auth::guard('admin');
    }

    protected function broker(){

        return Password::broker('admins');
    }

    // copied from vendor\laravel\framework\src\Illuminate\Foundation\Auth\ResetsPasswords to make admin password reset view
    public function showResetForm(Request $request, $token = null)
    {
        return view('myadmin.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
