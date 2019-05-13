@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.orderList')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 col-sm-12 col-xs-12">

            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th width="200">Order ID</th>
                     <th>Ordered By</th>
                     <th>Total Items</th>
                     <th>Status</th>
                     <th>Ordered on</th>
                     <th>Delivered on</th>
                     <th class="action-column">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(sizeof($orderList) > 0)
                  <?php $sn = 0;?>
                  @foreach($orderList as $order)
                  <?php $sn++;?>
                  <tr>
                     <td>{{$sn}}</td>
                     <td>
                        <a href="/admin/order-details/{{$order->id}}">
                           {{ $order->order_reference }}
                        </a>
                     </td>
                     <td>{{ $order->user->fname }} {{ $order->user->mname }} {{ $order->user->lname }}</td>
                     <td>{{ $order->totalItems}}</td>
                     <td>
                        @if($order->status==0)
                        <span class="danger-color order-status">NEW ORDER</span>
                        @elseif($order->status==1)
                        <span class="info-color order-status">ON PROCESS</span>
                        @elseif($order->status == 2)
                        <span class="success-color order-status">DELIVERED</span>
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
                     <td class="action-column">
                        <a title="View Details" href="/admin/order-details/{{$order->id}}"><i class=" fa fa-eye"
                              aria-hidden="true"></i></a>
                     </td>
                  </tr>
                  @endforeach
                  @endif
               </tbody>
            </table>
            <div class="pagination-wrapper">
               {{ $orderList->links() }}
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