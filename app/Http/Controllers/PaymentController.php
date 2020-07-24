<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct(PaymentService $paymentService)
    {
        $this->middleware('auth');
        $this->paymentService = $paymentService;
    }

    public function payWithPaypal(Request $request)
    {
        $order = null;
        $cart = session()->get('cart');
        if ($cart) {
            $this->paymentService->payWithPaypal($cart);
        }

        if ($order) {
            Session::flash('status', 'Your order is placed. Check your email for further information');
            return redirect('my-orders');
        } else {
            return redirect()->back();
        }
    }

    public function getPaymentStatus()
    {
        $token = $_GET['token'];
        $payerId = $_GET['PayerID'];
        $paymentId =  $_GET['paymentId'];

        return $this->paymentService->getPaymentStatus($token, $payerId, $paymentId);
    }
}