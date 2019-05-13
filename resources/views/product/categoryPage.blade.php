@extends('layouts.app')
@section('content')
<div class="container">
   <div class="col-md-12 product-header">
      <h1>{{$category[0]->name}} <small>Buy your favorite arts at any time with reasonable price.</small></h1>
   </div>

   @if(sizeof($products) > 0)
   @foreach ($products as $product)
   <div class="search-result">
      <div class="col-md-2 col-sm-12 ">
         <div class="col-md-12 product">
            <div class="product-image">
               <img
                  src="<?php echo url('storage/'.$product->images[0]->image_url)?>"
                  alt="product image">
            </div>

            @if($product->options->is_on_auction)
            <div class="product-title">
               <h2>{{ $product->name}}</h2>
               <h3>Estimated cost: ${{$product->options->estimated_price}}</h3>
               <p>
                  Expires in:<br /> <span id="{{$product->id}}"></span>
                  <script>
                     document.getElementById("{{$product->id}}").innerHTML =
                        moment(new Date("{{$product->options->auction_final_date}}")).format(
                           "MMM Do YYYY, HH:mm a"
                        )
                  </script>
               </p>
            </div>
            <div class="col-md-12 bid-product-button">
               <a class="btn btn-info"
                  href="<?php echo url('auction/'.$product->slug)?>">@lang('messages.bid')</a>

            </div>
            <div class="option-watermark">
               ON AUCTION
            </div>
            @else
            <div class="product-title">
               <h2>{{ $product->name}}</h2>
               <h3>Price: $
                  <?php
                     $originalPrice = $product->options->price;
                     $discountPercentage = $product->options->discount;
                     $priceAfterDiscount = $originalPrice - (($discountPercentage / 100) * $originalPrice);
                     echo $priceAfterDiscount;
                  ?>
               </h3>
               <p> <s> ${{$product->options->price}} </s>&nbsp;<span class="discount-percentage">
                     -{{$product->options->discount}}%</span>
               </p>
            </div>
            <div class="col-md-12 bid-product-button">
               <a class="btn btn-info" href="/add-to-cart/{{$product->slug}}">@lang('messages.addToCart')</a>
            </div>
            <div class="option-watermark">
               ON SELL
            </div>
            @endif
         </div>

      </div>
   </div>
   @endforeach
   <div class="col-md-12 pagination-wrapper">
      {{ $products->links() }}
   </div>
   @else
   <div class="col-md-12">
      <span>Theres no any product under this category.</span>
   </div>
   @endif
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection