<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Mail;
use Session;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /* 
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dump($data);
        // die();
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        Session::flash('status','Registered Successfully! now verify your email to activate your account.');

        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verify_token' => Str::random(40)  //generating default token
            //
        ]);

        // sending email link to verify a/c
        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);

        return $user;
    }

    public function veryEmailFirst(){

        return view('email.verifyEmailFirst');
    }

    // to send email verification
    public function sendEmail($thisUser){

        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken){

        $user = User::where(['email'=>$email,'verify_token' => $verifyToken])->first();
        if($user){
            $verified = user::where(['email'=>$email,'verify_token' => $verifyToken])->update(['status' => '1', 'verify_token' => NULL]);
            if($verified){

                return redirect('/home')->with('status','Your account is verified.');   
            }
           

        }else{
            //the flash message always go only in redirected path
            return redirect('/login')->with('status','Token already used.');
        }
    }
}
