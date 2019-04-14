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

    protected $redirectTo = '/';
    
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('guest')->except('userLogout');
        $this->categoryService = $categoryService;
    }

    /**
     * function copied from Illuminate\Foundation\Auth\AuthenticatesUsers to logout user guard
     */
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
        return $request->only($this->username(), 'password');
    }

    public function showLoginForm()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('auth.login')->with('categories', $categories);
    }
}
