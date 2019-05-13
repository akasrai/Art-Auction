@extends('layouts.app')
@section('content')
<div class="container" style="min-height:80vh">
   <div class="col-md-12 product-header clearfix">
      <h1>Your Shopping Cart <small>Your shopping cart items with details.</small></h1>
      @if (session('status'))
      <div class="alert alert-success">
         <i class="glyphicon glyphicon-ok-sign"></i>
         {{ session('status') }}
      </div>
      @endif

      @if (session('error'))
      <div class="alert alert-danger">
         <i class="glyphicon glyphicon-remove-sign"></i>
         {{ session('error') }}
      </div>
      @endif

      <div class="col-md-8 no-padding">
         <div class="col-md-12 your-cart-items">
            <table class="col-md-12 your-cart-items-table">
               <tr>
                  <th>Products</th>
                  <th>Price</th>
               </tr>

               @if(session('cart'))
               @foreach(session('cart') as $id => $details)
               <tr>
                  <td>
                     <div class="clearfix">
                        <div class="your-cart-items-image pull-left">
                           <img
                              src="<?php echo url('storage/'.$details['image'])?>"
                              alt="product image">
                        </div>
                        <div class="your-cart-items-details pull-left">
                           <a
                              href="<?php echo url('product/'.$details['slug']);?>">
                              <h2 class="item-name">{{$details['name']}}</h2>
                           </a>
                           <span class="item-quantity">Quantity: {{$details['quantity']}}</span>
                        </div>
                     </div>
                  </td>
                  <td>
                     <div class="clearfix">
                        <span>Original Price: <b>${{$details['price']}}</b></span>
                        <span class="danger-color">({{$details['discount']}}% off)</span><br>

                        <span class="final-price danger-color">
                           Final Price: $<?php
                                $originalPrice = $details['price'];
                                $discountPercentage = $details['discount'];
                                $priceAfterDiscount = $originalPrice - (($discountPercentage / 100) * $originalPrice);
                                echo $priceAfterDiscount;
                                ?>
                        </span>
                        <span>/item</span>
                        <br />
                        <a href="/remove-from-cart/{{$id}}">Remove</a>
                     </div>
                  </td>
               </tr>
               @endforeach
               @else
               <tr>
                  <td colspan="2">You haven't added any items to your cart yet.</td>
               </tr>
               @endif
            </table>
         </div>
      </div>

      <div class="col-md-4 no-mobile-padding">
         <div class="col-md-12 cart-items-calculator">
            <h2>Order Summary</h2>
            <table class="order-summary-table">
               <tr>
                  <th>Items</th>
                  <th>QTY</th>
                  <th>Price</th>
                  <th>Total</th>
               </tr>
               <?php $grandTotal = 0;?>
               @if(session('cart'))
               @foreach(session('cart') as $id => $details)
               <?php
                  $OP = $details['price'];
                  $DP = $details['discount'];
                  $PAD = $OP - (($DP / 100) * $OP);
                  $finalPrice=  $PAD * $details['quantity'];
                  $grandTotal += $finalPrice;
                  ?>
               <tr>
                  <td>
                     {{$details['name']}}
                  </td>
                  <td>
                     {{$details['quantity']}}
                  </td>
                  <td>
                     ${{$PAD}}
                  </td>
                  <td>
                     <span class="order-summery-price">
                        ${{$finalPrice}}
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
                  <td colspan="3">Gift Coupon</td>
                  <td><span class="order-summery-price">$0.00</span></td>
               </tr>
               <tr>
                  <td colspan="3">Special Discount</td>
                  <td>
                     <span class="order-summery-price">$0.00</span>
                  </td>
               </tr>
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
            <div class="order-summery-btn">
               <a href="/checkout" class="btn btn-default">CHECKOUT</a>
               <a href="/shop" class="btn btn-default">Continue Shopping</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection