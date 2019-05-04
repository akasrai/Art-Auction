<div>
   <h1>Hello {{$user->fname}} {{$user->mname}} {{$user->lname}} </h1>
   <p>
      Your orders with order id {{ $orders[0]->order->order_reference }} has been
      @if($orders[0]->order->status == 0)
      Placed.
      @elseif($orders[0]->order->status == 1)
      Processed.
      @elseif($orders[0]->order->status == 2)
      Delivered.
      @endif
   </p>
   <p>Your orders will be delivered in 3-4 business day.</p>
   <div class="col-md-12">
      <div class="col-md-6 order-details-column">
         <h2>Order Smmmery</h2>
         <div class="customer-details">
            <table class="order-summary-table">
               <tr>
                  <th>Items</th>
                  <th>QTY</th>
                  <th>Price</th>
                  <th>Total</th>
               </tr>
               <?php $grandTotal = 0;?>
               @if($orders)
               @foreach($orders as $order)
               <?php
                  $price = $order->price;
                  $finalPrice=  $price * $order->quantity;
                  $grandTotal += $finalPrice;
                  ?>
               <tr>
                  <td>
                     {{ $order->product_name }}
                  </td>
                  <td>
                     {{ $order->quantity }}
                  </td>
                  <td>
                     ${{ $price }}
                  </td>
                  <td>
                     <span class="order-summery-price">
                        ${{ $finalPrice }}
                     </span>
                  </td>
               </tr>
               @endforeach
               @endif
               <tr>
                  <td colspan="4">
                     <hr>
                  </td>
               </tr>
               <tr>
                  <td colspan="3"><span class="order-summery-price">GRAND TOTAL</span></td>
                  <td><span class="order-summery-price">${{$grandTotal}}</span></td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>