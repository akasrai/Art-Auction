@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.orderDetails')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 order-action-bar clearfix">

            @if(sizeof($orders) > 0)

            <div class="pull-left" style="padding:5px 0;">
               ORDER ID: <b>{{ $orders[0]->order->order_reference }}</b>
               &nbsp; | &nbsp;STATUS:
               @if($orders[0]->order->status==0)
               <span class="danger-color order-status">NEW ORDER</span>
               @elseif($orders[0]->order->status==1)
               <span class="info-color order-status">ON PROCESS</span>
               @elseif($orders[0]->order->status == 2)
               <span class="success-color order-status">DELIVERED</span>
               @endif

               &nbsp; | &nbsp;TOTAL ITEMS: <b>{{ sizeof($orders)}}</b>

               &nbsp; | &nbsp;ORDER DATE:
               <span id="{{$orders[0]->order->id}}" class="order-status"></span>
               <script>
                  document.getElementById("{{$orders[0]->order->id}}").innerHTML =
                     moment(new Date("{{$orders[0]->order->created_at}}")).format(
                        "MMM Do YYYY"
                     );
               </script>
            </div>

            <div class="pull-right">
               @if($orders[0]->order->status==0)

               <a class="btn btn-primary pull-left btn-modified"
                  onclick="confirmProcessOrder('{{$orders[0]->order->order_reference}}')"
                  href="javascript:void(0)">PROCESS ORDER</a>

               @elseif($orders[0]->order->status==1)

               <a class="btn btn-primary pull-left btn-modified"
                  onclick="confirmMarkDelivered('{{$orders[0]->order->order_reference}}')" href="#">MARK AS
                  DELIVERED</a>

               @endif
            </div>

            @endif
         </div>
         <div class="col-md-12 col-sm-12 col-xs-12 order-details">

            @if($customer)
            <div class="col-md-6 order-details-column">
               <div class="customer-details">
                  <h3> {{ $customer->fname}} {{ $customer->mname}} {{ $customer->lname}}</h3>
                  <p>
                     <i class="fa fa-envelope-square" aria-hidden="true"></i>
                     {{ $customer->email }}
                  </p>
                  <p>
                     <i class="fa fa-phone" aria-hidden="true"></i>
                     {{ $customer->phone_no }}
                  </p><br />
                  <p>
                     <i class="fa fa-map-marker" aria-hidden="true"></i>
                     <b>Delivery Address</b>
                  </p>
                  <p><b>Street:</b>{{ $customer->address_line}} </p>
                  <p>
                     <b>City:</b> {{ $customer->city}}
                  </p>
                  <p><b>State:</b> {{ $customer->state}}
                  </p>
                  <p>
                     <b>Country:</b> {{ $customer->country}}
                  </p>
                  <p>
                     <b>Zip Code:</b> {{ $customer->postal_code}}
                  </p>
               </div>
            </div>
            @endif

            <div class="col-md-6 order-details-column">
               <h2>Order Smmmery</h2>
               <div class="customer-details">
                  <table class="order-summary-table">
                     <tr>
                        <th>Items</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Total</th>
                     </tr>
                     <?php $grandTotal = 0;?>
                     @if($orders)
                     @foreach($orders as $order)
                     <?php
                        $price = $order->price;
                        $finalPrice=  $price * $order->quantity;
                        $grandTotal += $finalPrice;
                        ?>
                     <tr>
                        <td>
                           {{ $order->product_name }}
                        </td>
                        <td>
                           {{ $order->quantity }}
                        </td>
                        <td>
                           ${{ $price }}
                        </td>
                        <td>
                           <span class="order-summery-price">
                              ${{ $finalPrice }}
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
                        <td colspan="3"><span class="order-summery-price">GRAND TOTAL</span></td>
                        <td><span class="order-summery-price">${{$grandTotal}}</span></td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.orderItemList')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th width="300">Name</th>
                     <th>Quantity</th>
                     <th>Price</th>
                     <th>Status</th>
                     <th>Ordered on</th>
                     <th>Delivered on</th>
                  </tr>
               </thead>
               <tbody>
                  @if($orders)
                  <?php $sn = 0;?>
                  @foreach($orders as $order)
                  <?php $sn++;?>
                  <tr>
                     <td>{{$sn}}</td>
                     <td>
                        {{ $order->product_name }}
                     </td>
                     <td>
                        {{ $order->quantity }}
                     </td>
                     <td>
                        <span class="order-summery-price">
                           ${{ $order->price }}
                        </span>
                     </td>
                     <td>
                        @if($order->status==0)
                        <span class="danger-color">NEW ORDER</span>
                        @elseif($order->status==1)
                        <span class="info-color">ON PROCESS</span>
                        @elseif($order->status == 2)
                        <span class="success-color">DELIVERED</span>
                        @endif
                     </td>
                     <td>
                        <span id="{{$order->id}}"></span>
                        <script>
                           document.getElementById("{{$order->id}}").innerHTML =
                              moment(new Date("{{$order->created_at}}")).format(
                                 "MMM Do YYYY"
                              );
                        </script>
                     </td>
                     <td>
                        @if($order->status == 2)
                        <span id="delivered_{{$order->id}}"></span>
                        <script>
                           document.getElementById("delivered_{{$order->id}}").innerHTML =
                              moment(new Date("{{$order->updated_at}}")).format(
                                 "MMM Do YYYY"
                              );
                        </script>
                        @else
                        <span class="danger-color">PENDING</span>
                        @endif
                     </td>
                  </tr>
                  @endforeach
                  @endif
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
@section('scripts')
<script>
   function confirmProcessOrder(orderId) {
      let url = "{{url('admin/process-order')}}/" + orderId;
      confirm("Are you sure, you want to process this Order?", url);
   }

   function confirmMarkDelivered(orderId) {
      let url = "{{url('admin/mark-delivered')}}/" + orderId;
      confirm("Are you sure, this order is delivered?", url);
   }

   function confirm(msg, url) {
      window.Swal(msg, {
         buttons: ["No", "Yes"],
      }).then(res => {
         if (res) {
            window.location.href = url
         }
      });
   }
</script>
@endsection