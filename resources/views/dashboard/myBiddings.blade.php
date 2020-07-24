@extends('layouts.app')
@section('content')
<div class="container">
  <div class="col-md-12 dashboard-wrapper clearfix">
    <div class="col-md-3 menu-items-wrapper">
      @include('inc.dashboardSidebar')
    </div>

    <div class="col-md-9 no-mobile-padding">
      <div class="col-md-12 dashboard-content clearfix">
        <h3>My Biddings</h3>

        @if($myBiddingProducts)
        @foreach($myBiddingProducts as $myBiddingProduct)
        <div class="col-md-12 my-biddings-wrapper no-padding">
          @if(isset($myBiddingProduct->winner))
          @if(Auth::user()->id == $myBiddingProduct->winner->user->id)
          <div class="col-md-6">
            <div class="my-bid-product no-padding">
              <div class="alert alert-success auction-add-to-cart" role="alert">
                Congratulation! please add product to cart and checkout.
              </div>
              <a href="<?php echo url('auction/' . $myBiddingProduct->product->slug); ?>">
                <h2>{{$myBiddingProduct->product->name}}</h2>
              </a>
              <p>Estimated Price:
                <span class="danger-color">${{$myBiddingProduct->product->options->estimated_price}}</span></p>
              <p>Current Price: <span class="danger-color">${{$myBiddingProduct->highestBid}}</span></p>
              <div class="order-summery-btn col-md-5">
                <a href="/add-to-cart/{{$myBiddingProduct->product->slug}}" class="btn btn-default">ADD TO CART</a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="my-bid-product">
              <a href="<?php echo url('auction/' . $myBiddingProduct->product->slug); ?>">
                <img src="<?php echo url('storage/' . $myBiddingProduct->product->images[0]->image_url) ?>"
                  alt="product image">
              </a>
            </div>
          </div>
          @else
          <p>No product found</p>
          @endif
          @else
          <div class="col-md-8 ">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Amount</th>
                  <th>Comment</th>
                  <th width="180">Date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($myBiddingProduct->biddings as $bid)
                <tr>
                  <td>${{$bid->bid_price}}</td>
                  <td>{{$bid->comment}}</td>
                  <td>
                    <span id="{{$bid->id}}"></span>
                    <script>
                    document.getElementById("{{$bid->id}}").innerHTML =
                      moment(new Date("{{$bid->created_at}}")).format(
                        "MMM Do YYYY, HH:mm a"
                      )
                    </script>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="col-md-4 no-padding">
            <div class="my-bid-product">
              <a href="<?php echo url('auction/' . $myBiddingProduct->product->slug); ?>">
                <h4>{{$myBiddingProduct->product->name}}</h4>
              </a>
              <p>Estimated Price:
                <span class="danger-color">${{$myBiddingProduct->product->options->estimated_price}}</span></p>
              <p>Current Price: <span class="danger-color">${{$myBiddingProduct->highestBid}}</span></p>
              <a href="<?php echo url('auction/' . $myBiddingProduct->product->slug); ?>">
                <img src="<?php echo url('storage/' . $myBiddingProduct->product->images[0]->image_url) ?>"
                  alt="product image">

              </a>
            </div>
          </div>
          @endif
        </div>
        @endforeach
        @else
        <p>No product found</p>
        @endif
      </div>
    </div>

  </div>
</div>
</div>
@endsection
@section('scripts')
@endsection