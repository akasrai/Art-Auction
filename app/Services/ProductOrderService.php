<?php

namespace App\Services;

use Auth;
use App\Models\OrderList;
use App\Models\ProductOrder;
use App\Services\CartService;
use Illuminate\Support\Facades\Validator;

class ProductOrderService
{
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    
    public function placeOrder($cart)
    {
        try {
            $order = $this->saveOrder();
            if ($order) {
                $this->saveProductList($cart, $order->id);
                $this->cartService->emptyCart();
            }

            return $order;
        } catch (Exception $e) {
            dump($e);
        }
    }

    public function saveProductList($cart, $orderId)
    {
        foreach ($cart as $id => $details) {
            $price = $details['price']-(($details['discount']/100)*$details['price']);

            OrderList::create([
               "order_id" => $orderId,
               "product_id" => $id,
               "quantity" => $details['quantity'],
               "price" => $price
            ]);
        }
    }

    private function saveOrder()
    {
        $paymentMethod = "CASH_ON_DELIVERY";

        return ProductOrder::create([
         "order_reference" => uniqid(),
         "user_id" => Auth::user()->id,
         "payment_method" => $paymentMethod
      ]);
    }
}
