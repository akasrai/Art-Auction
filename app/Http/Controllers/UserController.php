<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ProductService;
use App\Services\CategoryService;

class UserController extends Controller
{
    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        UserService $userService
    ) {
        $this->middleware('auth');
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('user.profile')
                ->with('categories', $categories)
                ->with('user', Auth::user());
    }

    public function resendEmailVerificationLink()
    {
        $id = Auth::user()->id;
        $emailVerification = $this->userService->resendEmailVerificationLink($id);
        return response()->json(['status' => 200, 'message'=>'Email Verification link successfully sent to your email.']);
    }

    public function uploadProfileImage(Request $request)
    {
        $user = $this->userService->uploadProfileImage($request->all());
        if ($user) {
            return response()->json(['status' => 200, 'message' => 'Profile picture updated.']);
        } else {
            return response()->json(['status' => 500, 'message' => 'Something went wrong while updating your profile picture.']);
        }
    }

    public function update(Request $request)
    {
        $user = $this->userService->update($request->all());
        if ($user) {
            Session::flash('success', 'Profile updated successfully.');
            return redirect('profile');
        }
    }
}
