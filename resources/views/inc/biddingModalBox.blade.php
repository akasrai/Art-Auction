<script>
   let curentUser = "{{ Auth::user()->fname}} {{ Auth::user()->lname}}"
</script>
<div class="modal fade" id="bidding-details" tabindex="-1" role="dialog" aria-labelledby="smallModal"
   aria-hidden="true">
   <div class="modal-dialog modal-md">
      <div class="modal-content clearfix">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">
               <i class="glyphicon glyphicon-info-sign"></i> Bidding Details
            </h4>
         </div>

         @if($user->status == 1)
         <form name="bidding-placement" id="bidding-placement">
            <div class="modal-body clearfix">
               <div class="alert alert-success" id="alert-success">
                  <i class="glyphicon glyphicon-ok-sign"></i>
               </div>

               <div class="alert alert-danger" id="alert-error">
                  <i class="glyphicon glyphicon-remove-sign"></i>
               </div>


               <h4>Current price:
                  @if(sizeof($productDetails->auctions)>0)
                  <span class="current-price">${{$productDetails->auctions[0]->bid_price}}</span>
                  <script>
                     let currentPrice = parseInt("{{$productDetails->auctions[0]->bid_price}}");
                  </script>
                  @else
                  <span class="current-price">${{$productDetails->options->estimated_price}}</span>
                  <script>
                     let currentPrice = parseInt("{{$productDetails->options->estimated_price}}");
                  </script>
                  @endif
               </h4>
               <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
               <input type="hidden" name="product-id" id="product-id" value="{{$productDetails->id}}">
               <input type="hidden" name="user-id" id="user-id" value="{{ Auth::user()->id }}">

               <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding" id="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                     <input type="number" name="bidding-amount" id="bidding-amount" required="required"
                        class="form-control col-md-12 col-xs-12" autoComplete="off" placeholder="Enter your price">
                     <span id="error-msg" class="danger-color"></span>
                  </div>
               </div>

               <div class="form-group col-md-12 col-sm-12 col-xs-12 no-padding">
                  <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                     <textarea name="comment" id="comment" class="form-control col-md-12 col-xs-12"
                        placeholder="Any Comments"></textarea>

                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <div class="featured-product-button" style="width:100%;">
                  <a id="submit-bid" href="javascript:void(0)" onclick="submitBid()"
                     class="btn btn-info col-md-12">@lang('messages.placeBid')</a>
               </div>
            </div>
         </form>
         @else
         <div class="col-md-12 account-unverified-msg">
            <div class="alert alert-success" id="email-sent-success">
               <i class="glyphicon glyphicon-ok-sign"></i>
            </div>
            <p class="col-md-12">
               Please verify your account with link sent to your email to place bid on this product.
            </p>
            <p class="col-md-12">
               <a onclick="resendVerificationLink()" href="javascript:void(0)">Resend Verification Link</a>
               <i class="fa fa-spinner fa-spin" id="sending-verification-email-icon"></i>
            </p>
         </div>
         @endif
      </div>
   </div>
</div>

<script>
   function resendVerificationLink() {
      $("#sending-verification-email-icon").show();
      $.ajax({
         type: "GET",
         url: "{{url('resend-email-verification-link')}}",
         success: function(response) {
            if (response.status == 200) {
               $("#email-sent-success").show();
               $("#email-sent-success").delay(5000).fadeOut();
               $("#email-sent-success").append(response.message);
            }
            $("#sending-verification-email-icon").hide();
         },
         error: function(response) {}

      });
   }
</script>