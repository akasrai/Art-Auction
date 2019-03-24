<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Session;
use App\Models\User;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
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
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('guest');
        $this->categoryService = $categoryService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
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
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registered Successfully! now verify your email to activate your account.');

        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verify_token' => Str::random(40)
        ]);

        // sending email link to verify a/c
        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);

        return $user;
    }

    public function veryEmailFirst()
    {
        return view('email.verifyEmailFirst');
    }

    // to send email verification
    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where(['email'=>$email,'verify_token' => $verifyToken])->first();
        if ($user) {
            $verified = user::where(['email'=>$email,'verify_token' => $verifyToken])->update(['status' => '1', 'verify_token' => null]);
            if ($verified) {
                return redirect('/home')->with('status', 'Your account is verified.');
            }
        } else {
            //the flash message always go only in redirected path
            return redirect('/login')->with('status', 'Token already used.');
        }
    }

    public function showRegistrationForm()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('auth.register')->with('categories', $categories);
    }
}
