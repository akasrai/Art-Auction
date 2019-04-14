@extends('layouts.app')
@section('content')
<div class="container">
   <div class="col-md-12 product-header">
      <h1>Search Result <small>Buy your favorite arts at any time with reasonable price.</small></h1>
   </div>

   @if(sizeof($searchResults) > 0)
   @foreach ($searchResults as $searchResult)
   <div class="search-result">
      <div class="col-md-2 col-sm-12 ">
         <div class="col-md-12 product">
            <div class="product-image">
               <img
                  src="<?php echo url('storage/'.$searchResult->images[0]->image_url)?>"
                  alt="product image">
            </div>

            @if($searchResult->options->is_on_auction)
            <div class="product-title">
               <h2>{{ $searchResult->name}}</h2>
               <h3>Estimated cost: ${{$searchResult->options->estimated_price}}</h3>
               <p>
                  Expires in:<br /> <span id="{{$searchResult->id}}"></span>
                  <script>
                     document.getElementById("{{$searchResult->id}}").innerHTML =
                        moment(new Date("{{$searchResult->options->auction_final_date}}")).format(
                           "MMM Do YYYY, HH:mm a"
                        )
                  </script>
               </p>
            </div>
            <div class="col-md-12 bid-product-button">
               <a class="btn btn-info"
                  href="<?php echo url('product/'.$searchResult->slug)?>">@lang('messages.bid')</a>

            </div>
            <div class="option-watermark">
               ON AUCTION
            </div>
            @else
            <div class="product-title">
               <h2>{{ $searchResult->name}}</h2>
               <h3>Price: $
                  <span id="{{$searchResult->id}}"></span>
                  <script>
                     let originalPrice = parseInt("{{$searchResult->options->price}}");
                     let discountPercentage = parseInt("{{$searchResult->options->discount}}");
                     let priceAfterDiscount = originalPrice - ((discountPercentage / 100) * originalPrice);
                     document.getElementById("{{$searchResult->id}}").innerHTML = priceAfterDiscount;
                  </script>
               </h3>
               <p> <s> ${{$searchResult->options->price}} </s>&nbsp;<span class="discount-percentage">
                     -{{$searchResult->options->discount}}%</span>
               </p>
            </div>
            <div class="col-md-12 bid-product-button">
               <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
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
      {{ $searchResults->appends(request()->query())->links()}}
   </div>
   @else
   <div class="col-md-12">
      <span>No result</span>
   </div>
   @endif
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection