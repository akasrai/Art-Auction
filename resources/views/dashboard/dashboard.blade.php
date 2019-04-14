@extends('layouts.app')
@section('content')
<div class="container">
   <div class="col-md-12 dashboard-wrapper clearfix">
      <div class="col-md-3 menu-items-wrapper">
         @include('inc.dashboardSidebar')
      </div>

      <div class="col-md-9 ">
         <div class="dashboard-content">
            <h3>Dashboard</h3>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
@section('scripts')
@endsection