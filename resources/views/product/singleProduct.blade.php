@extends('layouts.app')
@section('content')
<div class="container">
   <div class="col-md-12 product-wrapper clearfix">
      <div class="col-md-12 no-padding single-product">
         @if($productDetails)
         <div class="product-option-section clearfix">
            <div class="col-md-4 colsm-12 col-xs-12 product-image-frame">
               <div class="image-large-view">
                  <img id="image-large-view"
                     src="<?php echo url('storage/'.$productDetails->images[0]->image_url)?>"
                     alt="image">
               </div>
               <div class="image-thumbnail-wrapper">
                  @foreach($productDetails->images as $image)
                  <div class="col-md-3 col-sm-3 col-xs-3 no-padding image-thumbnail">
                     <img onclick="changeImage(this.src)"
                        src="<?php echo url('storage/'.$image->image_url)?>"
                        alt="image">
                  </div>
                  @endforeach
               </div>
            </div>

            <div class="col-md-5 colsm-12 col-xs-12 product-info" style="padding:0;">
               <div class="featured-product-title clearfix" style="padding:20px 16px; text-align:left;">
                  <div class="col-md-12 no-padding clearfix">

                     <div class="col-md-12 no-padding live-auction-indicator"
                        style="width:100%; float:left; position:relative; margin: 0 0 10px 0">
                        @foreach($productDetails->categories as $category)
                        <span id="category" style="margin: 0 5px 0 0"><i class="fa fa-bookmark" aria-hidden="true"></i>
                           {{$category->name}} </span>
                        @endforeach
                     </div>

                     <h2>
                        {{$productDetails->name}}
                     </h2>
                     <hr>
                     Review | Share
                     <hr>
                     <p>Style: <span class="">{{$productDetails->style}}</span></p>
                     <p>Quality: <span class="">{{$productDetails->quality}}</span></p>
                     <p>Size: <span class="">{{$productDetails->size}}</span></p>
                     <p>Painted on: <span class="">{{$productDetails->painted_date}}</span></p>
                     <p>Painted by: <span class="">{{$productDetails->artist}}</span></p>
                  </div>
               </div>
            </div>

            <div class="col-md-3 colsm-12 col-xs-12 product-info product-option-bar">
               <div class="col-md-12 no-padding">
                  <div>
                     <span>Quantity</span>
                     <select name="quantity" id="">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                     </select>
                  </div>

                  <span class="final-price danger-color" style="font-size:25px">
                     Price: $<?php
                                $originalPrice = $productDetails->options->price;
                                $discountPercentage = $productDetails->options->discount;
                                $priceAfterDiscount = $originalPrice - (($discountPercentage / 100) * $originalPrice);
                                echo $priceAfterDiscount;
                                ?>
                  </span><br />
                  <span><s><b>${{$productDetails->options->price}}&nbsp;</b></s></span>
                  <span class="danger-color">(Save {{$productDetails->options->discount}}%)</span><br>
               </div>
               <div class="order-summery-btn">
                  <a href="/add-to-product/{{$productDetails->slug}}" class="btn btn-default">ADD TO CART</a>
                  <a href="/my-cart-items" class="btn btn-default">BUY NOW</a>
               </div>
            </div>
         </div>

         <div class="col-md-12 product-details ">
            <div class="col-md-12 no-padding details-label">
               <span>DETAILS</span>
            </div>
            <div>
               <p>{!! $productDetails->description !!}</p>
               <p>{!! $productDetails->materials_used !!}</p>
            </div>
         </div>
      </div>
      @endif
   </div>
</div>
@endsection
@section('scripts')
<script>
   function changeImage(imageUrl) {
      $("#image-large-view").attr("src", imageUrl);
   }
</script>
@endsection