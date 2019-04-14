<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Password;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/profile';

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('guest');
        $this->categoryService = $categoryService;
    }
    
    public function showResetForm(Request $request, $token = null)
    {
        $categories = $this->categoryService->getAllCategories();
        return view('auth.passwords.reset')
                ->with(['token' => $token, 'email' => $request->email])
                ->with('categories', $categories);
    }
}
