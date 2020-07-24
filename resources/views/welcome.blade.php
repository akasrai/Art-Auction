@extends('layouts.app')
@section('content')
<div class="container">

    @if (session('status'))
    <div class="col-md-12">
        <div class="col-md-12 alert alert-success">
            <i class="glyphicon glyphicon-ok-sign"></i>
            {{ session('status') }}
        </div>
    </div>
    @endif
    
    @if (session('error'))
    <div class="col-md-12">
        <div class="col-md-12 alert alert-danger">
            <i class="glyphicon glyphicon-remove-sign"></i>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <div class="col-md-12 product-wrapper clearfix">
        <span class="next-slider-button" onclick="nextProduct()">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </span>
        <span class="prev-slider-button" onclick="prevProduct()">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </span>
        <div class="featured-product-wrapper">
            @if($featuredProducts)
            @foreach($featuredProducts as $featuredProduct)
            @if($featuredProduct->options->is_on_auction)
            <script>
                window.auctionFinalDates.push("{{$featuredProduct->options->auction_final_date}}");
            </script>
            <div class="col-md-12 featured-product  clearfix">
                <div class="col-md-6 featured-product-image no-padding">
                    @foreach($featuredProduct->images as $productImage)
                    <img src="<?php echo url('storage/'.$productImage->image_url)?>"
                        alt="image">
                    @endforeach
                </div>
                <div class="col-md-6 featured-product-details no-padding-rights clearfix">
                    <div class="col-md-12 no-padding clearfix">
                        <div class="live-auction-indicator">
                            <span id="category"><i class="fa fa-bookmark" aria-hidden="true"></i>
                                {{$featuredProduct->categories[0]->name}} </span>
                            <span id="auction-live"><i class="fa fa-circle" aria-hidden="true"></i>
                                @lang('messages.live')</span>
                            <span id="auction-expired" class="hide"></span>
                        </div>
                    </div>
                    <div class="featured-product-title expires-in clearfix">
                        <p>
                            This auction ends in
                        </p>
                    </div>
                    <div class="col-md-12 no-padding auction-countdown-wrapper">
                        <div class="col-md-9 auction-coutdown">
                            <ul>
                                <li><span id="days">00</span>days</li>
                                <li><span id="hours">00</span>Hours</li>
                                <li><span id="minutes">00</span>Minutes</li>
                                <li><span id="seconds">00</span>Seconds</li>
                            </ul>
                        </div>
                    </div>
                    <div class="featured-product-title">
                        <h2>
                            {{$featuredProduct->name}}
                        </h2>
                        <p>
                            Ends in:
                            <span id="auction-final-date"></span>
                        </p>
                        <p>Estimated cost: ${{$featuredProduct->options->estimated_price}}</p>

                    </div>
                    <div class="col-md-12 featured-product-button-wrapper">
                        <div class="featured-product-button">
                            <a class="btn btn-info"
                                href="<?php echo url('auction/'.$featuredProduct->slug);?>">@lang('messages.bid')</a>
                            <a class="btn btn-danger"
                                href="<?php echo url('auction/'.$featuredProduct->slug);?>">@lang('messages.view')</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif

        </div>

    </diV>

    <div class="product-wrapper clearfix">
        <div class="col-md-12 product-header">
            <h1>Live Auction Now <small>Bid your favorite art before the time ends.</small></h1>
        </div>


        <div class="live-products">

            @if($productsOnAuction)
            @foreach ($productsOnAuction as $productOnAuction)
            <div class="col-md-2 col-sm-12 ">
                <div class="col-md-12 product">
                    <div class="product-image">
                        <div class="live-auction-indicator live-auction-grid">
                            <span><i class="fa fa-circle" aria-hidden="true"></i> @lang('messages.live')</span>
                        </div>
                        <img src="<?php echo url('storage/'.$productOnAuction->images[0]->image_url)?>"
                            alt="product image">
                    </div>
                    <div class="product-title">
                        <h2>{{$productOnAuction->name}}</h2>
                        <h3>Estimated cost: ${{$productOnAuction->options->estimated_price}}</h3>
                        <p>
                            Expires in:<br /> <span id="{{$productOnAuction->id}}"></span>
                            <script>
                                document.getElementById("{{$productOnAuction->id}}").innerHTML =
                                    moment(new Date("{{$productOnAuction->options->auction_final_date}}")).format(
                                        "MMM Do YYYY, HH:mm a"
                                    )
                            </script>
                        </p>
                    </div>
                    <div class="col-md-12 bid-product-button">
                        <a class="btn btn-info"
                            href="<?php echo url('auction/'.$productOnAuction->slug)?>">@lang('messages.bid')</a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="col-md-12 product-header">
        <h1>Products on Sell <small>Buy your favorite arts at any time with reasonable price.</small></h1>
    </div>


    <div class="products-on-sell">
        @if(sizeof($productsOnSell) > 0)
        @foreach($productsOnSell as $productOnSell)
        <div class="col-md-2 col-sm-12 ">
            <div class="col-md-12 product">
                <a
                    href="<?php echo url('product/'.$productOnSell->slug);?>">
                    <div class="product-image">
                        <img src="<?php echo url('storage/'.$productOnSell->images[0]->image_url)?>"
                            alt="product image">
                    </div>
                    <div class="product-title">
                        <h2>{{ $productOnSell->name}}</h2>
                        <h3>Price: $
                            <?php
                        $originalPrice = $productOnSell->options->price;
                        $discountPercentage = $productOnSell->options->discount;
                        $priceAfterDiscount = $originalPrice - (($discountPercentage / 100) * $originalPrice);
                        echo $priceAfterDiscount;
                        ?>
                        </h3>
                        <p> <s> ${{$productOnSell->options->price}} </s>&nbsp;<span class="discount-percentage">
                                -{{$productOnSell->options->discount}}%</span>
                        </p>
                    </div>
                </a>

                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="/add-to-cart/{{$productOnSell->slug}}">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/slider.js') }}"></script>
@endsection