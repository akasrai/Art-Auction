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
            return $this->paymentService->payWithPaypal($cart);
        }

        return redirect()->back();
    }

    public function getPaymentStatus()
    {
        $token = $_GET['token'];
        $payerId = $_GET['PayerID'];
        $paymentId =  $_GET['paymentId'];

        return $this->paymentService->getPaymentStatus($token, $payerId, $paymentId);
    }
}