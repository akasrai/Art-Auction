@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.auctionDetails')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 col-sm-12 col-xs-12">
            @if($auctionDetails)
            <div class="col-md-6">
               <div class="col-md-12 product-category">
                  @foreach($auctionDetails->categories as $category)
                  <span class="category-indicator">{{$category->name}}</span>
                  @endforeach
               </div>
               <h1>{{$auctionDetails->name}}</h1>
               <h2>Estimated price: ${{$auctionDetails->options->estimated_price}}</h2>
               <h2>Painted by: {{$auctionDetails->artist}}</h2>

               <h2>
                  <span id="final-date-label"></span>
                  <span id="ends-in"></span>
                  @if($auctionDetails->status == 1)
                  <script>
                     document.getElementById("ends-in").innerHTML =
                        moment(new Date("{{$auctionDetails->options->auction_final_date}}")).format(
                           "MMM Do YYYY HH:mm a"
                        );
                     if (!moment(new Date()).isAfter(new Date(
                           "{{$auctionDetails->options->auction_final_date}}"))) {
                        document.getElementById("final-date-label").innerHTML = 'Ends in:';
                     } else {
                        document.getElementById("final-date-label").innerHTML = 'Ended in:';
                     }
                  </script>
                  @else
                  <script>
                     document.getElementById("final-date-label").innerHTML = 'Ended in:';
                     document.getElementById("ends-in").innerHTML =
                        moment(new Date("{{$auctionDetails->updated_at}}")).format(
                           "MMM Do YYYY HH:mm a"
                        );
                  </script>
                  @endif
               </h2>
               <h2>Total bids: {{ $totalAuctionBids}}</h2>

               @if(sizeof($auctionDetails->auctions) > 0)
               <h2>Highest bids: ${{ $auctionDetails->auctions[0]->bid_price}}</h2>
               <h2>Highest Bidder:
                  {{ $auctionDetails->auctions[0]->user->fname}}
                  {{ $auctionDetails->auctions[0]->user->lname}}
               </h2>
               @endif

               <div class="col-md-6 no-padding hide" id="end-auction">
                  <button class="btn btn-danger btn-block btn-modified" id="{{$auctionDetails->slug}}"
                     onclick="confirmEndAuction(this.id)">
                     End Auction
                  </button>
               </div>
               <div class="col-md-6 no-padding hide" id="email-highest-bidder">
                  @if($totalAuctionBids > 0)
                  <button class="btn btn-primary btn-block btn-modified" id="{{$auctionDetails->id}}"
                     onclick="confirmEmailWiner(this.id)">
                     Email Winner
                  </button>
                  @endif
               </div>
               @if($auctionDetails->status == 1)
               <script>
                  if (!moment(new Date()).isAfter(new Date(
                        "{{$auctionDetails->options->auction_final_date}}"))) {
                     document.getElementById("end-auction").classList.remove("hide");
                  } else {
                     document.getElementById("email-highest-bidder").classList.remove("hide");
                  }
               </script>
               @else
               <script>
                  document.getElementById("email-highest-bidder").classList.remove("hide");
               </script>
               @endif
            </div>

            <div class="col-md-6">
               @if(sizeof($auctionDetails->images) == 1)
               <div class="col-md-8 product-image" style="height:100%;">
                  <img
                     src="<?php echo url('storage/'.$auctionDetails->images[0]->image_url)?>"
                     alt="product image" />
               </div>
               @else
               @foreach($auctionDetails->images as $image)
               <div class="col-md-4 product-image">
                  <img
                     src="<?php echo url('storage/'.$image->image_url)?>"
                     alt="product image" />
               </div>
               @endforeach
               @endif
            </div>
            @endif
         </div>
      </div>
   </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.biddersList')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th width="200">Name</th>
                     <th>Email</th>
                     <th>Comments</th>
                     <th>Bid Price</th>
                     <th>Last Bid on</th>
                  </tr>
               </thead>
               <tbody>
                  @if(sizeof($auctionDetails->auctions)>0)
                  @foreach($auctionDetails->auctions as $auction)
                  <tr>
                     <td></td>
                     <td>{{$auction->user->fname}} {{$auction->user->lname}}</td>
                     <td>{{$auction->user->email}}</td>
                     <td>{{$auction->comment}}</td>
                     <td>${{$auction->bid_price}}</td>
                     <td>
                        <span id="{{$auction->id}}_auction"></span>
                        <script>
                           document.getElementById("{{$auction->id}}_auction").innerHTML =
                              moment(new Date("{{$auction->created_at}}")).format(
                                 "MMM Do YYYY HH:mm a"
                              );
                        </script>
                     </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                     <td colspan="6">There's no any bids placed for this product.</td>
                  </tr>
                  @endif
               </tbody>
            </table>
            <div class="pagination-wrapper">
               {!! $auctionDetails->auctions->render() !!}
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
@section('scripts')
<script>
   let url = "";

   function confirmEndAuction(productUrl) {
      url = "{{url('admin/end-auctions')}}/" + productUrl;
      confirm("Are you sure you want end this Auction?", url);
   }

   function confirmEmailWiner(productId) {
      url = "{{url('admin/email-winner')}}/" + productId;
      confirm("Are you sure you want email winner?", url);
   }

   function confirm(msg, url) {
      window.Swal(msg, {
         buttons: ["cancel", true],
      }).then(res => {
         if (res) {
            window.location.href = url
         }
      });
   }
</script>
@endsection