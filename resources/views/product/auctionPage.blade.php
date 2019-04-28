@extends('layouts.app')
@section('content')
<div class="container">
   <div class="col-md-12 product-header">
      <h1>Products on auction <small>Bid your favorite art before the time ends.</small></h1>
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
                  href="<?php echo url('product/'.$product->slug)?>">@lang('messages.bid')</a>

            </div>
            <div class="option-watermark">
               ON AUCTION
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