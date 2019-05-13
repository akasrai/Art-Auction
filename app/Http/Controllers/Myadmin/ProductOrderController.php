<?php

namespace App\Http\Controllers\Myadmin;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProductOrderService;

class ProductOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductOrderService $productOrderService)
    {
        $this->middleware('auth:admin');
        $this->middleware('superadmins' || 'editor' || 'admins' || 'moderator');
        $this->productOrderService = $productOrderService;
    }


    public function getOrderList()
    {
        $orderList = $this->productOrderService->getOrderList();
       
        return view('myadmin.product.orderList')->with('orderList', $orderList);
    }

    public function getOrderDetails($orderId)
    {
        $orderDetails = $this->productOrderService->getOrderDetailsById($orderId);
       
        return view('myadmin.product.orderDetails')
               ->with('orders', $orderDetails)
               ->with('customer', $orderDetails[0]->order->user);
    }

    public function processOrder($orderId)
    {
        $order = $this->productOrderService->processOrder($orderId);

        return redirect('/admin/order-details/'.$order->id);
    }

    public function markAsDelivered($orderId)
    {
        $order = $this->productOrderService->markAsDelivered($orderId);
        
        return redirect('/admin/order-details/'.$order->id);
    }
}
