@extends('layouts.app')
@section('content')
<div class="container">
  <div class="col-md-12 product-wrapper clearfix">
    <div class="col-md-12 no-padding single-product">
      @if($productDetails)
      <div class="col-md-4 colsm-12 col-xs-12 product-image-frame">
        <div class="image-large-view">
          <img id="image-large-view" src="<?php echo url('storage/' . $productDetails->images[0]->image_url) ?>"
            alt="image">
        </div>
        <div class="image-thumbnail-wrapper">
          @foreach($productDetails->images as $image)
          <div class="col-md-3 col-sm-3 col-xs-3 no-padding image-thumbnail">
            <img onclick="changeImage(this.src)" src="<?php echo url('storage/' . $image->image_url) ?>" alt="image">
          </div>
          @endforeach
        </div>
      </div>

      @if($productDetails->options->is_on_auction)
      <div class="col-md-4 colsm-12 col-xs-12 product-info" style="padding:0;">
        <div class="featured-product-title" style="margin:16px; text-align:left;">
          <h2>
            {{$productDetails->name}}
          </h2>
          <p>Style: <span class="">{{$productDetails->style}}</span></p>
          <p>Quality: <span class="">{{$productDetails->quality}}</span></p>
          <p>Size: <span class="">{{$productDetails->size}}</span></p>
          <p>Painted on: <span class="">{{$productDetails->painted_date}}</span></p>
          <p>Painted by: <span class="">{{$productDetails->artist}}</span></p>
          <p>Estimated cost: <span class="">${{$productDetails->options->estimated_price}}</span></p>
          <p>
            <span id="ends-in" style="font-weight:normal;"></span>
            <span id="auction-final-date" class=""></span>
            @if($productDetails->status == 1)
            <script>
            document.getElementById("ends-in").innerHTML = "Ends in:"
            document.getElementById("auction-final-date").innerHTML =
              moment(new Date("{{$productDetails->options->auction_final_date}}")).format(
                "MMM Do YYYY, HH:mm a"
              );
            auctionCountDown("{{$productDetails->options->auction_final_date}}");
            </script>
            @else
            <script>
            document.getElementById("ends-in").innerHTML = "Ended in:"
            document.getElementById("auction-final-date").innerHTML =
              moment(new Date("{{$productDetails->updated_at}}")).format(
                "MMM Do YYYY, HH:mm a"
              );
            </script>
            @endif
          </p>
        </div>

        <div class="col-md-12 no-padding auction-countdown-wrapper">
          <div class="col-md-12 auction-coutdown">
            <ul>
              <li><span id="days">00</span>days</li>
              <li><span id="hours">00</span>Hours</li>
              <li><span id="minutes">00</span>Minutes</li>
              <li><span id="seconds">00</span>Seconds</li>
            </ul>
          </div>
        </div>

        <div class="col-md-12 featured-product-button-wrapper">
          <div class="featured-product-button" style="width:100%;">
            @guest
            <a class="btn btn-info col-md-12" href="/login">
              <i class="glyphicon glyphicon-user"></i> @lang('messages.loginToBid')
            </a>
            @else
            @if($productDetails->status == 1)
            <a class="btn btn-info col-md-12" data-toggle="modal" data-target="#bidding-details"
              href="javascript:void(0)">@lang('messages.bid')</a>
            @endif
            @endguest
          </div>
        </div>
      </div>

      <div class="col-md-4 colsm-12 col-xs-12 product-info">
        <div class="col-md-12 no-padding clearfix">
          <div class="live-auction-indicator">
            @foreach($productDetails->categories as $category)
            <span id="category"><i class="fa fa-bookmark" aria-hidden="true"></i>
              {{$category->name}} </span>
            @endforeach

            <span id="auction-live"><i class="fa fa-circle" aria-hidden="true"></i>
              @lang('messages.live')</span>
            <span id="auction-expired" class="hide"></span>
          </div>

          <div class="col-md-12 final-sale-price-section">
            <span class="pull-left final-sale-label">Current sales price</span>
            @if(sizeof($productDetails->auctions)>0)
            <span class="pull-right final-sale-price current-price">${{$productDetails->auctions[0]->bid_price}}</span>
            @else
            <span
              class="pull-right final-sale-price current-price">${{$productDetails->options->estimated_price}}</span>
            @endif
          </div>

          <div id='highestBidder'>
            <div class="col-md-12 highest-bidder">

              <div class="col-md-12 no-padding highest-bidder-label">
                <span>Current Highest Bidder</span>
              </div>
              @if(sizeof($productDetails->auctions)>0)
              <div class="no-padding col-md-2">
                <div class="highest-bidder-image">
                  @if(!$productDetails->auctions[0]->user->image)
                  <i class="glyphicon glyphicon-user"></i>
                  @else
                  <img src="<?php echo url('storage/' . $productDetails->auctions[0]->user->image); ?>"
                    alt="bidder-image" />
                  @endif
                </div>
              </div>
              <div class="no-padding col-md-10 highest-bidder-name">
                <span class="current-highest-bidder">{{$productDetails->auctions[0]->user->fname}}
                  {{$productDetails->auctions[0]->user->lname}}</span>
              </div>
              <div class="no-padding col-md-12">
                <span id="bidder-comment">
                  {{$productDetails->auctions[0]->comment}}
                </span>
              </div>
              @else
              <div class="no-padding col-md-12">
                <span>
                  No bid has been placed yet in this product.
                </span>
              </div>
              @endif
            </div>
          </div>


          <div class="col-md-12 no-padding latest-bidder">
            @if(sizeof($productDetails->auctions)>0)
            <table class="col-md-12 slatest-bidder-table">
              <tbody id="bidders-info">
                @foreach($productDetails->auctions as $auction)
                <tr>
                  <td width="70">${{$auction->bid_price}}</td>
                  <td>{{$auction->user->fname}} {{$auction->user->lname}}</td>
                  <td class="pull-right">
                    <span id="{{$auction->id}}"></span>
                    <script>
                    document.getElementById("{{$auction->id}}").innerHTML =
                      moment(new Date("{{$auction->created_at}}")).format(
                        "MMM Do YYYY, HH:mm a"
                      );
                    </script>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="fade-buttom"></div>
            @endif
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
    @endif
  </div>
</div>
</div>

@auth
@include('inc.biddingModalBox')
@endauth
@endsection
@section('scripts')
<script>
$("#alert-error").hide();
$("#alert-success").hide();
$("#email-sent-success").hide();
$("#sending-verification-email-icon").hide();

function changeImage(imageUrl) {
  $("#image-large-view").attr("src", imageUrl);
}

let isLoggedIn = false;

function submitBid() {
  if (!getValueOf('bidding-amount')) {
    $("#bidding-amount").focus();
    $("#form-group").addClass("has-error");
    $("#error-msg").text("Bidding amount cannot be empty.");

  } else if (getValueOf('bidding-amount') < currentPrice) {
    $("#bidding-amount").focus();
    $("#form-group").addClass("has-error");
    $("#error-msg").text("Bidding amount less than current price.");

  } else {
    $.ajax({
      type: "POST",
      url: "{{url('bid/product')}}",
      data: {
        _token: getValueOf("_token"),
        userId: getValueOf("user-id"),
        comment: getValueOf("comment"),
        productId: getValueOf("product-id"),
        biddingAmount: getValueOf("bidding-amount")
      },
      success: function(response) {
        $("#bidding-amount").val("");
        if (response.id && response.status == 200) {

          currentPrice = parseInt(response.biddingAmount);

          $("#alert-success").show();
          $("#alert-success").delay(5000).fadeOut();
          $("#alert-success").append("Your bid is successfully placed.");

          let newRow = "<tr><td>$" + response.biddingAmount +
            "</td><td>" + curentUser + "</td><td class='pull-right'>" +
            moment(new Date(response.createdAt)).format(
              "MMM Do YYYY, HH:mm a"
            ); +
          "</td></tr>";

          $("#bidders-info").prepend(newRow);
          $("#bidder-comment").text(response.comment);
          $(".current-highest-bidder").text(curentUser);
          $(".current-price").text("$" + response.biddingAmount);
        } else {
          $("#alert-error").show();
          $("#alert-error").delay(5000).fadeOut();
          $("#alert-error").append("Something went wrong. Please try again.");
        }
      },
      error: function(response) {
        $("#alert-error").show();
        $("#alert-error").delay(5000).fadeOut();
        $("#alert-error").append("Something went wrong. Please try again.")
      }

    });
  }
}

$("#bidding-amount").keyup(function() {
  $("#error-msg").empty();
  $("#form-group").removeClass("has-error");

})

function getValueOf(id) {
  return $("#" + id).val();
}

$(() => {
  const slugArr = window.location.pathname.split('/');
  const slug = slugArr[2];
  let seeClient = new EventSource(`/auction/l/${slug}`);

  seeClient.addEventListener("message", function(e) {
    const res = JSON.parse(e.data);
    if (res.length) {
      const [highestBidderData] = res;
      if (highestBidderData) {
        const bidderName = highestBidderData.user.name;
        const bidComment = highestBidderData.comment;
        const imgContent = highestBidderData.user.image ?
          `<img src="/storage/${highestBidderData.user.image}" alt="bidder-image" />` :
          `<i class="glyphicon glyphicon-user"></i>`
        $(".highest-bidder-image").html(imgContent);
        $(".current-highest-bidder").html(bidderName);
        $("#bidder-comment").html(bidComment);
      }
    }

  }, false);

  seeClient.addEventListener('error', event => {
    if (event.readyState == EventSource.CLOSED) {
      console.error('Event was closed');
      console.log(EventSource);
    }
  }, false);


})
</script>
@endsection