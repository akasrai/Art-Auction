<?php

namespace App\Services;

use Mail;
use Auth;
use App\Mail\orderStatus;
use App\Models\OrderList;
use App\Models\ProductOrder;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Validator;

class ProductOrderService
{
    public function __construct(CartService $cartService, ProductService $productService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    public function placeOrder($cart, $paymentMethod)
    {
        try {
            $order = $this->saveOrder($paymentMethod);
            if ($order) {
                $this->saveProductList($cart, $order->id);
                $this->cartService->emptyCart();
                $this->emailStatus($order);
            }

            return $order;
        } catch (Exception $e) {
            dump($e);
        }
    }

    public function saveProductList($cart, $orderId)
    {
        foreach ($cart as $id => $details) {
            $price = $details['price'] - (($details['discount'] / 100) * $details['price']);

            OrderList::create([
                "order_id" => $orderId,
                "product_id" => $id,
                "quantity" => $details['quantity'],
                "price" => $price
            ]);
        }
    }

    private function saveOrder($paymentMethod)
    {
        return ProductOrder::create([
            "order_reference" => uniqid(),
            "user_id" => Auth::user()->id,
            "payment_method" => $paymentMethod
        ]);
    }

    public function getOrderList()
    {
        $orderList = ProductOrder::orderBy('created_at', 'DESC')->paginate(20);
        foreach ($orderList  as $order) {
            $order->totalItems = $this->getItemsCount($order->id);
        }
        return $orderList;
    }

    public function getOrderDetailsById($orderId)
    {
        $orderItems = OrderList::where('order_id', $orderId)->get();
        $orderItemsWithName = array();

        foreach ($orderItems as $item) {
            $item->product_name = $this->productService->getNameById($item->product_id);
            array_push($orderItemsWithName, $item);
        }

        return $orderItemsWithName;
    }

    private function getItemsCount($orderId)
    {
        return OrderList::where('order_id', $orderId)->count();
    }

    public function processOrder($orderId)
    {
        $order = ProductOrder::where('order_reference', $orderId)->first();
        $order->status = 1;

        if ($order->save()) {
            $updateItems = $this->markAllItems($order->id, 1);

            if ($updateItems) {
                $this->emailStatus($order);

                return $order;
            }
        }
    }

    public function markAsDelivered($orderId)
    {
        $order = ProductOrder::where('order_reference', $orderId)->first();
        $order->status = 2;

        if ($order->save()) {
            $updateItems = $this->markAllItems($order->id, 2);

            if ($updateItems) {
                $this->emailStatus($order);

                return $order;
            }
        }
    }

    private function markAllItems($orderId, $status)
    {
        return OrderList::where('order_id', $orderId)->update(['status' => $status]);
    }

    private function emailStatus($order)
    {
        $customerEmail = $order->user->email;
        $orders = $this->getOrderDetailsById($order->id);

        return Mail::to($customerEmail)->send(new orderStatus($order->user, $orders));
    }

    public function getAllByUser($userId)
    {
        $orders = ProductOrder::where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(5);
        $ordersWithItems = collect(new ProductOrder);

        foreach ($orders as $order) {
            $order->items = $this->getItemsByOrderId($order->id);
            $ordersWithItems->push($order);
        }

        $ordersWithPagination = array();
        array_push($ordersWithPagination, $ordersWithItems);
        array_push($ordersWithPagination, $orders->links());

        return $ordersWithPagination;
    }

    private function getItemsByOrderId($orderId)
    {
        return OrderList::where('order_id', $orderId)->get();
    }
}