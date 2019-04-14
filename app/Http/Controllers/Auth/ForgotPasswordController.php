<?php

namespace App\Http\Controllers\Auth;

use Password;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('guest');
        $this->categoryService = $categoryService;
    }

    public function showLinkRequestForm()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('auth.passwords.email')->with('categories', $categories);
    }
}
