@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.auctionList')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 col-sm-12 col-xs-12">
            @if(sizeof($auctionProductList)>0)
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th width="400">Name</th>
                     <th>Category</th>
                     <th>Status</th>
                     <th>Image</th>
                     <th>Published on</th>
                     <th class="action-column">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($auctionProductList as $auctionProduct)
                  <tr>
                     <td></td>
                     <td><b>
                           <a
                              href="<?php echo url('admin/auctions/'.$auctionProduct->slug)?>">
                              {{ $auctionProduct->name}}
                           </a>
                        </b></td>
                     <td>
                        @foreach($auctionProduct->categories as $category)
                        <span class="category-indicator"> {{ $category->name}}</span>
                        @endforeach
                     </td>

                     <td>
                        @if($auctionProduct->status == 1)
                        <span class="color-red" id="{{$auctionProduct->slug}}"></span>
                        <script>
                           $element = document.getElementById("{{$auctionProduct->slug}}");
                           if (!moment(new Date()).isAfter(new Date(
                                 "{{$auctionProduct->options->auction_final_date}}"))) {
                              $element.innerHTML = 'LIVE';
                              $element.classList.add('color-red');
                           } else {
                              $element.innerHTML = 'EXPIRED';
                              $element.classList.add('color-blue');
                           }
                        </script>
                        @else
                        <span class="color-blue">EXPIRED</span>
                        @endif
                     </td>

                     <td>
                        <div class="auction-product-list-image">
                           <img
                              src="<?php echo url('storage/'.$auctionProduct->images[0]->image_url)?>"
                              alt="product image" />
                        </div>
                     </td>
                     <td>
                        <span id="{{$auctionProduct->id}}"></span>
                        <script>
                           document.getElementById("{{$auctionProduct->id}}").innerHTML =
                              moment(new Date("{{$auctionProduct->options->created_at}}")).format(
                                 "MMM Do YYYY"
                              );
                        </script>
                     </td>
                     <td class="action-column">
                        <a
                           href="<?php echo url('admin/product/edit/'.$auctionProduct->slug)?>">
                           <span class="glyphicon glyphicon-edit action-edit"></span></a>
                        <span class="glyphicon glyphicon-trash action-delete"></span>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            <div class="pagination-wrapper">
               {{ $auctionProductList->links() }}
            </div>
            @endif
         </div>
      </div>
   </div>
</div>

@endsection
@section('scripts')
<script>
</script>
@endsection