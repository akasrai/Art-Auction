<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ProductOrderService;

class UserController extends Controller
{
    public function __construct(
        UserService $userService,
        ProductService $productService,
        CategoryService $categoryService,
        ProductOrderService $productOrderService
    ) {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productOrderService = $productOrderService;
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

    public function updateAddress(Request $request)
    {
        $user = $this->userService->updateAddress($request->all());
        if ($user) {
            return response()->json([
                'status'=>200
                ]);
        }
    }

    public function getOrders()
    {
        $categories = $this->categoryService->getAllCategories();

        $orders = $this->productOrderService->getAllByUser(Auth::user()->id);
    
        if (sizeof($orders) > 0) {
            return view('user.orders')
            ->with('orders', $orders[0])
            ->with('paginate', $orders[1])
            ->with('categories', $categories);
        }
    }
}
