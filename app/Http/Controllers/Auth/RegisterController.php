<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use App\Models\User;
use App\Services\UserService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct(
        CategoryService $categoryService,
        UserService $userService
    ) {
        $this->middleware('web');
        $this->userService = $userService;
        $this->categoryService = $categoryService;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|min:10|max:10',
        ]);
    }
    
    protected function create(array $data)
    {
        $user = $this->userService->save($data);
        if ($user) {
            Session::flash('status', 'Registered Successfully! now verify your email with link sent to your email.');
        }
        return $user;
    }

    public function verifyEmail($email, $verifyToken)
    {
        if (Auth::user()) {
            $user = User::where(['email'=>$email,'verify_token' => $verifyToken])->first();
            if ($user) {
                $verified = $this->userService->verifyEmail($email, $verifyToken);
                if ($verified) {
                    return redirect('/profile')->with('status', 'Your account is verified.');
                }
            } else {
                return redirect('/profile')->with('error', 'This token is already used. Please, request again for new verification link.');
            }
        } else {
            return redirect('/login')->with('status', 'Please login first to verify your account.');
        }
    }

    public function showRegistrationForm()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('auth.register')->with('categories', $categories);
    }
}
