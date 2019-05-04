<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\ProductOrderService;

class ProductOrderController extends Controller
{
    public function __construct(ProductOrderService $productOrderService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->productOrderService = $productOrderService;
        $this->categoryService = $categoryService;
    }

    public function getCheckoutForm()
    {
        $categories = $this->categoryService->getAllCategories();
        $cart = session()->get('cart');
        if ($cart) {
            return view('product.checkout')
                ->with('user', Auth::user())
                ->with('categories', $categories);
        } else {
            Session::flash('error', 'You have no any item in cart.');

            return redirect()->back();
        }
    }

    public function placeOrder()
    {
        $order = null;
        $cart = session()->get('cart');
        if ($cart) {
            $order = $this->productOrderService->placeOrder($cart);
        }
       
        if ($order) {
            Session::flash('status', 'Your order is placed. Check your email for further information');
            return redirect('my-orders');
        } else {
            return redirect()->back();
        }
    }
}
