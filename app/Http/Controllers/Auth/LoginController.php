<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('guest')->except('userLogout');
        $this->categoryService = $categoryService;
    }

    // function copied from Illuminate\Foundation\Auth\AuthenticatesUsers to logout user guard
    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['email' =>$request->{$this->username()},'password' => $request->password, 'status'=>'0']; // checkig active or blocked users
    }

    public function showLoginForm()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('auth.login')->with('categories', $categories);
    }
}
