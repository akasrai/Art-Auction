@extends('layouts.app')
@section('content')
<div class="container" style="min-height:80vh">
   <div class="col-md-12 product-header clearfix">
      <h1>Checkout <small>We deliver your choices to your doorstep.</small></h1>
      <div class="col-md-8 no-padding">
         <div class="col-md-12 dashboard-content" id="delivery-details">
            <h3>
               Delivery Details
            </h3>

            <form id="delivery-details-form">
               <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
               <input type="hidden" name="user-id" id="user-id" value="{{ $user->id }}" />

               <div class="col-md-12">
                  <div class="form-group row">
                     <label for="payment-option" class="col-sm-12 col-form-label no-padding">Payment Option</label>
                     <select id="payment-option" class="form-control" name="payment-option" required>
                        <option value=""> Select Payment Option </option>
                        <option value="CASH_ON_DELIVERY"> Cash on delivery </option>
                     </select>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="form-group row">
                     <label for="address-line" class="col-sm-12 col-form-label no-padding">Address Line</label>
                     <input id="address-line" type="text" class="form-control" name="address-line"
                        value="{{$user->address_line}}" autofocus autocomplete="off" required />
                  </div>
               </div>

               <div class="col-md-12 no-padding">
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label for="city" class="col-sm-12 col-form-label no-padding">City</label>
                        <input id="city" type="text" class="form-control" name="city" value="{{$user->city}}" autofocus
                           autocomplete="off" required />
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label for="state" class="col-sm-12 col-form-label no-padding">State</label>
                        <input id="state" type="text" class="form-control" name="state" value="{{$user->state}}"
                           autofocus autocomplete="off" required />
                     </div>
                  </div>
               </div>

               <div class="col-md-12 no-padding">
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label for="country" class="col-sm-12 col-form-label no-padding">Country</label>
                        <input id="country" type="text" class="form-control" name="country" value="{{$user->country}}"
                           autofocus autocomplete="off" required />
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label for="postal-code" class="col-sm-12 col-form-label no-padding">Postal Code</label>
                        <input id="postal-code" type="text" class="form-control" name="postal-code"
                           value="{{$user->postal_code}}" autofocus autocomplete="off" required />
                     </div>
                  </div>
               </div>

               <div class="col-md-12 no-padding">
                  <div class="col-md-12">
                     <div class="form-group row">
                        <a href="javascript:void(0)" class="btn btn-primary auction-default-btn col-md-12"
                           id="save-details">Save
                           Details</a>
                     </div>
                  </div>
               </div>
            </form>
         </div>

         <div id="review-page" class="col-md-12 dashboard-content hide">
            <h3>Review Details</h3>
            <div class="review-page">
               <span id="review-page-name">{{$user->fname}} {{$user->mname}} {{$user->lname}}</span>
               <span>Email : {{$user->email}}</span>
               <span>Phone : {{$user->phone_no}}</span>
               <div id="address" class="review-section">

                  <h3><i class="fa fa-map-marker" aria-hidden="true"></i> Delivery Address</h3>
               </div>

               <div id="payment-option-r" class="review-section">
                  <h3><i class="fa fa-credit-card" aria-hidden="true"></i> Payment Option</h3>
               </div>

               <div class="col-md-3 no-padding" style="margin-top:20px;">
                  <a href="/place-order" class="btn btn-primary auction-default-btn" id="place-order">Confirm
                     Order</a>
               </div>
            </div>
         </div>
      </div>

      <div class="col-md-4 no-mobile-padding">
         <div class="col-md-12 cart-items-calculator">
            <h2>Order Summary</h2>
            <table class="order-summary-table">
               <tr>
                  <th>Items</th>
                  <th>QTY</th>
                  <th>Price</th>
                  <th>Total</th>
               </tr>
               <?php $grandTotal = 0;?>
               @if(session('cart'))
               @foreach(session('cart') as $id => $details)
               <?php
                  $OP = $details['price'];
                  $DP = $details['discount'];
                  $PAD = $OP - (($DP / 100) * $OP);
                  $finalPrice=  $PAD * $details['quantity'];
                  $grandTotal += $finalPrice;
                  ?>
               <tr>
                  <td>
                     {{$details['name']}}
                  </td>
                  <td>
                     {{$details['quantity']}}
                  </td>
                  <td>
                     ${{$PAD}}
                  </td>
                  <td>
                     <span class="order-summery-price">
                        ${{$finalPrice}}
                     </span>
                  </td>
               </tr>
               @endforeach
               @endif
               <tr>
                  <td colspan="4">
                     <hr>
                  </td>
               </tr>
               <tr>
                  <td colspan="3">Gift Coupon</td>
                  <td><span class="order-summery-price">$0.00</span></td>
               </tr>
               <tr>
                  <td colspan="3">Special Discount</td>
                  <td>
                     <span class="order-summery-price">$0.00</span>
                  </td>
               </tr>
               <tr>
                  <td colspan="4">
                     <hr>
                  </td>
               </tr>
               <tr>
                  <td colspan="3"><span class="order-summery-price">GRAND TOTAL</span></td>
                  <td><span class="order-summery-price">${{$grandTotal}}</span></td>
               </tr>
            </table>
            <div class="order-summery-btn">
               <a href="/shop" class="btn btn-default">Continue Shopping</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
      let html = "";
      let focus = false;

      $("#save-details").click(function() {
         focus = false;

         const address = {
            userId: $("#user-id").val(),
            _token: $("#_token").val(),
            addressLine: $("#address-line").val(),
            city: $("#city").val(),
            state: $("#state").val(),
            country: $("#country").val(),
            zipCode: $("#postal-code").val(),
         }

         const validation = validateForm();
         if (validation) {
            saveDetails(address);
         }
      });

      $("input").change(function() {
         $('#' + this.id + '+ span').remove();
      })

      $("select").change(function() {
         $('#' + this.id + '+ span').remove();
      })

      function validateForm() {

         let validation = true;
         const formData = $("#delivery-details-form").serializeArray();

         for (let i = 0; i < formData.length; i++) {
            if (formData[i].value === "") {
               $("#" + formData[i].name).after(onError(formData[i].name));
               validation = false;
            }
         }

         return validation;
      }

      function onError(id) {
         $('#' + id + '+ span').remove();
         if (!focus) {
            $('#' + id).focus();
            focus = true;
         }
         return '<span class="danger-color">This field cannot be empty.</span>'
      }

      function saveDetails(payload) {
         $.ajax({
            type: "POST",
            url: "{{url('/address/update')}}",
            data: payload,
            success: function(response) {
               displayReview(payload);
            },
            error: function(response) {}
         });
      }

      function displayReview(address) {
         const addressLabel = {
            addressLine: "Addres Line",
            city: "City",
            state: "State",
            country: "Country",
            zipCode: "Zip Code",
         }

         const paymentOption = $("#payment-option").val();

         $("#payment-option-r").append(`<span><b>Payment Option</b>: ${paymentOption}</span>`);

         Object.keys(addressLabel).forEach((key, index) => {
            html = `<span><b>${addressLabel[key]}</b>: ${address[key]}</span>`
            $('#address').append(html);
         });

         $("#delivery-details").addClass("hide");
         $("#review-page").removeClass("hide");
      }

      $("#place-order").click(function() {
         $.ajax({
            type: "GET",
            url: "{{url('/address/update')}}",
            success: function(response) {

            },
            error: function(response) {}
         });
      });
   })
</script>
@endsection