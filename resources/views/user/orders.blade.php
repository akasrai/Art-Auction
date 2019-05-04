@extends('layouts.app')
@section('content')
<div class="container" style="min-height:75vh">
   <div class="col-md-12 dashboard-wrapper clearfix">
      <div class="col-md-3 menu-items-wrapper">
         @include('inc.dashboardSidebar')
      </div>

      <div class="col-md-9 no-mobile-padding">
         <div class="col-md-12 dashboard-content clearfix">
            <h3>
               My Orders
            </h3>

            <div class="col-md-12 no-padding">
               @if (session('status'))
               <div class="alert alert-success">
                  <i class="glyphicon glyphicon-ok-sign"></i>
                  {{ session('status') }}
               </div>
               @endif

               @if (session('error'))
               <div class="alert alert-danger">
                  <i class="glyphicon glyphicon-remove-sign"></i>
                  {{ session('error') }}
               </div>
               @endif
            </div>

            @if(sizeof($orders) > 0)
            @foreach( $orders as $order)
            <div class="order-action-bar clearfix">
               <div class="pull-left" style="padding:5px 0;">
                  ORDER ID: <b>{{ $order->order_reference}}</b>
                  &nbsp; | &nbsp;STATUS:
                  @if($order->status==0)
                  <span class="danger-color order-status">NEW ORDER</span>
                  @elseif($order->status==1)
                  <span class="info-color order-status">ON PROCESS</span>
                  @elseif($order->status == 2)
                  <span class="success-color order-status">DELIVERED</span>
                  @endif

                  &nbsp; | &nbsp;TOTAL ITEMS: <b>{{ sizeof($order->items)}}</b>

                  &nbsp; | &nbsp;ORDER DATE:
                  <span id="{{$order->id}}" class="order-status"></span>
                  <script>
                     document.getElementById("{{$order->id}}").innerHTML =
                        moment(new Date("{{$order->created_at}}")).format(
                           "MMM Do YYYY"
                        );
                  </script>
               </div>
            </div>
            <div class="order-table-wrapper">
               <table class="order-summary-table">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th width="400">Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $sn = 1; $grandTotal = 0;?>
                     @foreach($order->items as $item)
                     <tr>
                        <td>{{$sn}}</td>
                        <td>
                           <a
                              href="<?php echo url('product/'.$item->product->slug);?>">
                              {{ $item->product->name}}
                           </a>
                        </td>
                        <td><span>{{ $item->quantity}}</span></td>
                        <td><span>${{ $item->price}}</span></td>
                        <td><span>${{ $item->quantity * $item->price }}</span></td>
                     </tr>
                     <?php $sn++; $grandTotal += $item->quantity * $item->price?>
                     @endforeach
                     <tr>
                        <td colspan="5">
                           <hr>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="4"><span class="order-summery-price">GRAND TOTAL</span></td>
                        <td><span class="order-summery-price">${{$grandTotal}}</span></td>
                     </tr>
                  </tbody>
               </table>
            </div>
            @endforeach
            <div class="pagination-wrapper">
               {{ $paginate }}
            </div>
            @endif

         </div>
      </div>

   </div>
</div>
</div>
@endsection
@section('scripts')
<script>

</script>
@endsection