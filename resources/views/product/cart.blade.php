@extends('layouts.app')
@section('content')
<div class="container">
   <div class="col-md-12 product-header no-padding">
      <h1>Your Shopping Cart <small>Your shopping cart items with details.</small></h1>
      <div class="col-md-8 no-padding">
         <div class="col-md-12 no-padding your-cart-items ">
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
                           <h2 class="item-name">{{$details['name']}}</h2>
                           <span class="item-quantity">Quantity: {{$details['quantity']}}</span>
                        </div>
                     </div>
                  </td>
                  <td>
                     <div class="clearfix">
                        <span>Original Price: ${{$details['price']}}</span>
                        <span>(Save {{$details['discount']}}%)</span><br>

                        <span class="danger-color">
                           Final Price: $<?php
                                $originalPrice = $details['price'];
                                $discountPercentage = $details['discount'];
                                $priceAfterDiscount = $originalPrice - (($discountPercentage / 100) * $originalPrice);
                                echo $priceAfterDiscount;
                                ?>
                        </span>
                     </div>
                  </td>
               </tr>
               @endforeach
               @endif
            </table>
         </div>
      </div>

      <div class="col-md-4 no-padding">
         here
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection