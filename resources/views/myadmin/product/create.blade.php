@extends('myadmin.layouts.app')

@section('content')
@if($product->exists)
<form id="create-product" method="POST" enctype="multipart/form-data" action="{{ route('admin.product.update') }}">
   <input type="hidden" name="product-id" value="{{$product->id}}">
   @else
   <form id="create-product" enctype="multipart/form-data" method="POST" action="{{ route('admin.product.submit') }}">
      @endif
      <div class="col-md-9 col-sm-12 col-xs-12">
         <div class="x_panel tile">
            <div class="x_title clearfix">
               <h2 class="pull-left">@lang('titles.productDetails')</h2>
               @if($product->exists)
               <a href="/admin/product/create" class="pull-right btn btn-primary btn-modified">Add New Product</a>
               @endif
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="text" name="name" id="name" required="required"
                           class="form-control col-md-7 col-xs-12" autoComplete="off" placeholder="Name"
                           value="{{old('name',$product->name)}}" />
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        @include('myadmin.inc.slugwidget')
                     </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="switch-field">
                           @if( $product->options && $product->options->is_on_auction == 1)
                           <input type="radio" id="switch_left" name="product-option" value="0" />
                           <label for="switch_left"><i class="fa fa-money" aria-hidden="true"></i> ON SELL</label>
                           <input type="radio" id="switch_right" name="product-option" value="1" checked />
                           <label for="switch_right"><i class="fa fa-bar-chart" aria-hidden="true"></i> ON
                              AUCTION</label>
                           @else
                           <input type="radio" id="switch_left" name="product-option" value="0" checked />
                           <label for="switch_left"><i class="fa fa-money" aria-hidden="true"></i> ON SELL</label>
                           <input type="radio" id="switch_right" name="product-option" value="1" />
                           <label for="switch_right"><i class="fa fa-bar-chart" aria-hidden="true"></i> ON
                              AUCTION</label>
                           @endif
                        </div>
                     </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12 col-xs-12" id="auction-option">
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group date' id='auction-date-picker'>
                           <input type='text' id="auction-final-date" name="auction-final-date"
                              class="form-control col-md-7 col-xs-12" placeholder="Auction final date"
                              autocomplete="off"
                              value="{{old('auction-final-date',$product->options ? $product->options->auction_final_date:null)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group'>
                           <input type="text" id="estimated-price" name="estimated-price"
                              class="form-control col-md-7 col-xs-12" autoComplete="off" placeholder="Estimated price"
                              value="{{old('estimated-price', $product->options ?$product->options->estimated_price:null)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-usd"></span>
                           </span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12 col-xs-12" id="sell-option">
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group'>
                           <input type="number" id="price" name="price" class="form-control col-md-7 col-xs-12"
                              autoComplete="off" placeholder="Price"
                              value="{{old('price', $product->options ? $product->options->price:null)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-usd"></span>
                           </span>
                        </div>
                     </div>

                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group'>
                           <input type="text" id="discount" name="discount" class="form-control col-md-7 col-xs-12"
                              autoComplete="off" placeholder="Discount"
                              value="{{old('discount', $product->options ? $product->options->discount:null)}}" />

                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-minus-sign"></span>
                           </span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group date' id='painted-date-picker'>
                           <input type='text' id="painted-date" name="painted-date" autocomplete="off"
                              class="form-control col-md-7 col-xs-12" placeholder="Painted on"
                              value="{{old('painted_date',$product->painted_date)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group'>
                           <input type="text" id="quality" name="quality" class="form-control col-md-7 col-xs-12"
                              autoComplete="off" placeholder="Quality" value="{{old('quality',$product->quality)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-ok-sign"></span>
                           </span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group'>
                           <input type="text" id="style" name="style" class="form-control col-md-7 col-xs-12"
                              autoComplete="off" placeholder="Style" value="{{old('style',$product->style)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-tasks"></span>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class='input-group'>
                           <input type="text" id="artist" name="artist" class="form-control col-md-7 col-xs-12"
                              autoComplete="off" placeholder="Artist" value="{{old('artist',$product->artist)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-user"></span>
                           </span>
                        </div>
                     </div>
                  </div>

                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class='input-group'>
                           <input type="text" id="size" name="size" class="form-control col-md-7 col-xs-12"
                              autoComplete="off" placeholder="Size" value="{{old('size',$product->size)}}" />
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-resize-horizontal"></span>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="picture-grid" id="upload-preview">
                           @if($product->images)
                           @foreach($product->images as $image)
                           <div class="grid-box">
                              <img
                                 src="<?php echo url('storage/'.$image->image_url)?>"
                                 alt="image">
                           </div>
                           @endforeach
                           @endif
                        </div>
                        <input type="file" name="images[]" id="upload-image" multiple="multiple" />
                     </div>
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea placeholder="Description . . ." id="description"
                           class="form-control col-md-7 col-xs-12 description" type="text"
                           name="description">{{old('description',$product->description)}}</textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
         <div class="panel panel-default">
            <div class="panel-heading">@lang('titles.publish')</div>
            <div class="panel-body">
               <button class="btn btn-primary pull-left btn-modified">
                  @if($product->exists)
                  Update
                  @else
                  Publish
                  @endif
               </button>
               <a class="btn btn-default pull-right btn-modified">Preview</a>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-publish-info">
                  <br />
                  <p>
                     <i class="fa fa-hourglass-2" aria-hidden="true"></i>&nbsp;&nbsp;Status: Draft <br />
                     <span style="padding-left:20px;">Saved a few minutes ago.</span>
                  </p>
                  <div>
                     <i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;Publish:
                     <div class="publish-date-wrapper">
                        <span class=""
                           id="publish-date-display">{{old('publish-date',$product->created_at? $product->created_at :'Immediately')}}</span>
                        <input type="text" name="publish-date" id="publish-date" readonly />
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel panel-default">
            <div class="panel-heading">
               @lang('titles.category')
            </div>
            <div class="panel-body">
               <div class="">
                  @if(count($categories)>0)
                  @foreach($categories as $category)
                  <div class="checkbox checkbox-primary">
                     @if($product->exists)

                     @foreach($product->categories as $pCategory)

                     @if($category->name == $pCategory->name)
                     <input type="checkbox" name="category[]" value="{{$category->id}}" checked>
                     @break
                     @else
                     <input type="checkbox" name="category[]" value="{{$category->id}}">
                     @endif

                     @endforeach

                     @else

                     @if($category->name=='Uncategorized')
                     <input type="checkbox" name="category[]" value="{{$category->id}}" checked>
                     @else
                     <input type="checkbox" name="category[]" value="{{$category->id}}">
                     @endif

                     @endif
                     <label for="">
                        {{$category->name}}
                     </label>
                  </div>
                  @endforeach
                  @else
                  <p>No Category are created yet.</p>
                  @endif
               </div>
               <a href="/admin/category/create"
                  class="btn btn-primary btn-block full-width btn-modified">@lang('titles.addCategory')</a>
            </div>
         </div>
      </div>
   </form>
   @endsection
   @section('scripts')
   <script>
      $(document).ready(function() {
         if (!$("#slug").val()) $('#upload-preview').hide();
         $("#sell-option").show();
         $("#auction-option").hide();
         $('#auction-date-picker').datetimepicker();
         $('#painted-date-picker').datetimepicker({
            format: 'yyyy-mm-dd'
         });

         $('#publish-date').datetimepicker();

         window.Laravel.apiToken = '{{Auth::user()->api_token}}';

         let currentOption = $("input[name='product-option']:checked").val();
         changeProductOption(currentOption);

         function readImage(file) {
            var reader = new FileReader();
            var image = new Image();

            reader.readAsDataURL(file);
            reader.onload = function(_file) {
               image.src = _file.target.result; // url.createObjectURL(file);
               image.onload = function() {
                  var w = this.width,
                     h = this.height,
                     t = file.type, // ext only: // file.type.split('/')[1],
                     n = file.name,
                     s = ~~(file.size / 1024) + 'KB';
                  $('#upload-preview').append('<div class="grid-box"><img src="' + this.src + '"></div>');
               };

               image.onerror = function() {
                  let invalidImageMessage =
                     '<div class="alert alert-danger custom-alert-box">Invalid file type: ' + file.type +
                     '</div>';
                  $(".custom-alert-wrapper").html(invalidImageMessage);
                  $(".alert").delay(5000).fadeOut();
               };
            };

         }

         $("#upload-image").change(function(e) {
            $('#upload-preview').show();
            $("#upload-preview").empty();
            if (this.disabled) {
               return alert('File upload not supported!');
            }

            var F = this.files;
            if (F && F[0]) {
               for (var i = 0; i < F.length; i++) {
                  readImage(F[i]);
               }
            }
         });

         $("#publish-date").change(function(e) {
            // $("#publish-date-display").text(moment(new Date($("#publish-date").val())).format(
            //    'MMM Do YYYY'));
            $("#publish-date-display").text("");
         });

         $("input[type=radio][name=product-option]").change(function() {
            changeProductOption(this.value)
         });

         function changeProductOption(option) {
            if (parseInt(option) === 0) {
               $("#sell-option").show();
               $("#auction-option").hide();
            } else if (parseInt(option) === 1) {
               $("#sell-option").hide();
               $("#auction-option").show();
            }
         }

         // Prevents re submitting of form.
         if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
         }

         // Ckeditor integration to textarea.
         CKEDITOR.replace('description');

      })
   </script>
   @endsection