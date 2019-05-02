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