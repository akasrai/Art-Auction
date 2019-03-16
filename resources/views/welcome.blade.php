@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12 col sm-12 search-bar">
        <form class="search-form">
            <div class="col-md-8 col-sm-12 no-padding input-group">
                <div class="col-md-4 col-sm-12 no-padding">
                    <input type="text" class="form-control custom-form-element" placeholder="Anything">
                </div>

                <div class="col-md-3 col-sm-12 no-padding custom-select">
                    <select name="" id="" class="form-control custom-form-element">
                        <option value="">CATEGORY</option>
                        <option value="">Option 1</option>
                    </select>
                </div>

                <div class="col-md-3 col-sm-12 no-padding custom-select">
                    <select name="" id="" class="form-control custom-form-element">
                        <option value="">PRICE RANGE</option>
                        <option value="">Option 1</option>
                    </select>
                </div>

                <div class="col-md-2 col-sm-12 no-padding">
                    <button class="form-control btn-search">SEARCH</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12 product-wrapper clearfix">
        <div class="col-md-12 featured-product  clearfix">
            <div class="col-md-6 featured-product-image no-padding">
                <img src="{{ asset('images/g.jpg') }}" alt="Profile Image" />
            </div>
            <div class="col-md-6 featured-product-details no-padding-rights clearfix">
                <div class="col-md-12 no-padding clearfix">
                    <div class="live-auction-indicator">
                        <span id="category"><i class="fa fa-bookmark" aria-hidden="true"></i> FEATURED </span>
                        <span id="auction-live"><i class="fa fa-circle" aria-hidden="true"></i> @lang('messages.live')</span>
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
                        <!-- <div class="expires-in">
                            <span>Expires in</span>
                        </div> -->
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
                        Mantra Mandala
                    </h2>
                    <p>Auction final date: December 06, 2018</p>
                    <p>Estimated cost: $500 - $2000</p>
                </div>
                <div class="col-md-12 featured-product-button-wrapper">
                    <div class="featured-product-button">
                        <a class="btn btn-info" href="javascript:void(0)">@lang('messages.bid')</a>
                        <a class="btn btn-danger" href="javascript:void(0)">@lang('messages.view')</a>
                    </div>
                </div>
            </div>
        </div>
    </diV>

    <div class="product-wrapper clearfix">
        <div class="col-md-12 product-header">
            <h1>Live Auction Now <small>Bid your favorite art before the time ends.</small></h1>
        </div>
        <div class="live-products">
            <div class="col-md-3 col-sm-12 ">
                <div class="col-md-12 product">
                    <div class="product-image">
                        <div class="live-auction-indicator live-auction-grid">
                            <span><i class="fa fa-circle" aria-hidden="true"></i> @lang('messages.live')</span>
                        </div>
                        <img src="{{ asset('images/e.jpg') }}" alt="Profile Image" />
                    </div>
                    <div class="product-title">
                        <h2>Mantra Mandala</h2>
                        <h3>Estimated cost: $500 - $2000</h3>
                        <p>Exoires in: Mar 20, 2019</p>
                    </div>
                    <div class="col-md-12 bid-product-button">
                        <a class="btn btn-info" href="javascript:void(0)">@lang('messages.bid')</a>
                    </div>
                </div>

            </div>

            <div class="col-md-3 col-sm-12">
                <div class="col-md-12 col-sm-12 product">
                    <div class="product-image">
                        <div class="live-auction-indicator live-auction-grid">
                            <span><i class="fa fa-circle" aria-hidden="true"></i> @lang('messages.live')</span>
                        </div>
                        <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                    </div>
                    <div class="product-title">
                        <h2>Mantra Mandala</h2>
                        <h3>Estimated cost: $500 - $2000</h3>
                        <p>Exoires in: Mar 20, 2019</p>
                    </div>
                    <div class="col-md-12 bid-product-button">
                        <a class="btn btn-info" href="javascript:void(0)">@lang('messages.bid')</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <div class="col-md-12 col-sm-12 product">
                    <div class="product-image">
                        <div class="live-auction-indicator live-auction-grid">
                            <span><i class="fa fa-circle" aria-hidden="true"></i> @lang('messages.live')</span>
                        </div>
                        <img src="{{ asset('images/e.jpg') }}" alt="Profile Image" />
                    </div>
                    <div class="product-title">
                        <h2>Mantra Mandala</h2>
                        <h3>Estimated cost: $500 - $2000</h3>
                        <p>Exoires in: Mar 20, 2019</p>
                    </div>
                    <div class="col-md-12 bid-product-button">
                        <a class="btn btn-info" href="javascript:void(0)">@lang('messages.bid')</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12 ">
                <div class="col-md-12 col-sm-12 product">
                    <div class="product-image">
                        <div class="live-auction-indicator live-auction-grid">
                            <span><i class="fa fa-circle" aria-hidden="true"></i> @lang('messages.live')</span>
                        </div>
                        <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                    </div>
                    <div class="product-title">
                        <h2>Mantra Mandala</h2>
                        <h3>Estimated cost: $500 - $2000</h3>
                        <p>Exoires in: Mar 20, 2019</p>
                    </div>
                    <div class="col-md-12 bid-product-button">
                        <a class="btn btn-info" href="javascript:void(0)">@lang('messages.bid')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 product-header">
        <h1>Products on Sell <small>Buy your favorite arts at any time with reasonable price.</small></h1>
    </div>

    <div class="products-on-sell">
        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/e.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>

        </div>

        <div class="col-md-3 col-sm-12">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/e.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 ">
            <div class="col-md-12 col-sm-12 product">
                <div class="product-image">
                    <img src="{{ asset('images/d.jpg') }}" alt="Profile Image" />
                </div>
                <div class="product-title">
                    <h2>Mantra Mandala</h2>
                    <h3>Estimated cost: $500 - $2000</h3>
                    <p>Exoires in: Mar 20, 2019</p>
                </div>
                <div class="col-md-12 bid-product-button">
                    <a class="btn btn-info" href="javascript:void(0)">@lang('messages.addToCart')</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/auction-count-down.js') }}"></script>
<script src="{{ asset('js/custom-select.js') }}"></script>
@endsection