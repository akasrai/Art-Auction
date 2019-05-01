@extends('layouts.app')
@section('content')
<div class="container">
   <div class="col-md-12 product-header">
      <h1>Products on sell <small>Buy your favorite arts at any time with reasonable price.</small></h1>
   </div>

   @if(sizeof($products) > 0)
   @foreach ($products as $product)
   <div class="search-result">
      <div class="col-md-2 col-sm-12 ">
         <div class="col-md-12 product">
            <a
               href="<?php echo url('product/'.$product->slug);?>">
               <div class="product-image">
                  <img
                     src="<?php echo url('storage/'.$product->images[0]->image_url)?>"
                     alt="product image">
               </div>
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
                  <a class="btn btn-info" href="/add-to-product/{{$product->slug}}">@lang('messages.addToCart')</a>
               </div>
            </a>

            <div class="option-watermark">
               ON SELL
            </div>
         </div>
      </div>
   </div>
   @endforeach
   <div class="col-md-12 pagination-wrapper">
      {{ $products->links() }}
   </div>
   @else
   <div class="col-md-12">
      <span>Theres no any product yet.</span>
   </div>
   @endif
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection