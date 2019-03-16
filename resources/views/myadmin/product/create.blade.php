@extends('myadmin.layouts.app')

@section('content')
<form id="create-product" enctype="multipart/form-data" method="POST" action="{{ route('admin.product.submit') }}">
   <div class="col-md-9 col-sm-12 col-xs-12">
      <div class="x_panel tile">
         <div class="x_title">
            <h2>@lang('titles.addProduct')</h2>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <div class="col-md-12 col-sm-12 col-xs-12">
               <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <input type="text" name="name" id="name" required="required"
                        class="form-control col-md-7 col-xs-12" autoComplete="off" placeholder="Name">
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     @include('myadmin.inc.slugwidget')
                  </div>
               </div>

               <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="switch-field">
                        <input type="radio" id="switch_left" name="product-option" value="0" checked />
                        <label for="switch_left"><i class="fa fa-money" aria-hidden="true"></i> ON SELL</label>
                        <input type="radio" id="switch_right" name="product-option" value="1" />
                        <label for="switch_right"><i class="fa fa-bar-chart" aria-hidden="true"></i> ON AUCTION</label>
                     </div>
                  </div>
               </div>

               <div class="form-group col-md-12 col-sm-12 col-xs-12" id="auction-option">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <!-- <input type="text" id="auction-final-date" name="auction-final-date"
                        class="form-control col-md-7 col-xs-12" autoComplete="off" placeholder="Auction final date"
                        onfocus="(this.type='datetime-local')" onblur="(this.type='text')"> -->

                     <div class='input-group date' id='auction-date-picker'>
                        <input type='text' id="auction-final-date" name="auction-final-date"
                           class="form-control col-md-7 col-xs-12" placeholder="Auction final date" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class='input-group'>
                        <input type="text" id="estimated-price" name="estimated-price"
                           class="form-control col-md-7 col-xs-12" autoComplete="off" placeholder="Estimated price">
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
                           autoComplete="off" placeholder="Price">
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-usd"></span>
                        </span>
                     </div>
                  </div>

                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class='input-group'>
                        <input type="text" id="discount" name="discount" class="form-control col-md-7 col-xs-12"
                           autoComplete="off" placeholder="Discount">

                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-minus-sign"></span>
                        </span>
                     </div>
                  </div>
               </div>

               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <!-- <input type="text" id="painted-date" name="painted-date" class="form-control col-md-7 col-xs-12"
                        autoComplete="off" placeholder="Painted on" onfocus="(this.type='date')"
                        onblur="(this.type='text')"> -->

                     <div class='input-group date' id='painted-date-picker'>
                        <input type='text' id="painted-date" name="painted-date" class="form-control col-md-7 col-xs-12"
                           placeholder="Painted on" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class='input-group'>
                        <input type="text" id="quality" name="quality" class="form-control col-md-7 col-xs-12"
                           autoComplete="off" placeholder="Quality">
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-ok-sign"></span>
                        </span>
                     </div>
                  </div>
               </div>

               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class='input-group'>
                        <input type="text" id="painted" name="style" class="form-control col-md-7 col-xs-12"
                           autoComplete="off" placeholder="Style">
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-tasks"></span>
                        </span>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class='input-group'>
                        <input type="text" id="painted" name="artist" class="form-control col-md-7 col-xs-12"
                           autoComplete="off" placeholder="Artist">
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-user"></span>
                        </span>
                     </div>
                  </div>
               </div>

               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <textarea placeholder="Materials used . . ." id="materials-used"
                        class="form-control col-md-7 col-xs-12" type="text" name="materials-used"></textarea>
                  </div>
               </div>
               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="picture-grid" id="upload-preview">
                     </div>
                     <input type="file" name="images[]" id="upload-image" multiple="multiple" />
                  </div>
               </div>
               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <textarea placeholder="Description . . ." id="description"
                        class="form-control col-md-7 col-xs-12 description" type="text" name="description"></textarea>
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
            <button class="btn btn-primary pull-left btn-modified">Publish</button>
            <button class="btn btn-default pull-right btn-modified">Preview</button>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-publish-info">
               <br />
               <p>
                  <i class="fa fa-hourglass-2" aria-hidden="true"></i>&nbsp;&nbsp;Status: Draft <br />
                  <span style="padding-left:20px;">Saved a few minutes ago.</span>
               </p>
               <div>
                  <i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;Publish:
                  <div class="publish-date-wrapper">
                     <span class="" id="publish-date-display">Immediately</span>
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
                  @if($category->name=='Uncategorized')
                  <input id="" type="checkbox" name="category[]" value="{{$category->id}}" checked>
                  @else
                  <input id="" type="checkbox" name="category[]" value="{{$category->id}}">
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
      $('#upload-preview').hide();
      $("#sell-option").show();
      $("#auction-option").hide();
      $('#auction-date-picker').datetimepicker({
         format: 'yyyy-mm-dd HH:ii'
      });
      $('#painted-date-picker').datetimepicker({
         format: 'yyyy-mm-dd'
      });

      $('#publish-date').datetimepicker({
         format: 'yyyy-mm-dd HH:ii'
      });

      window.Laravel.apiToken = '{{Auth::user()->api_token}}';

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
         if (parseInt(this.value) === 0) {
            $("#sell-option").show();
            $("#auction-option").hide();
         } else if (parseInt(this.value) === 1) {
            $("#sell-option").hide();
            $("#auction-option").show();
         }
      });

      // Prevents re submitting of form.
      if (window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href);
      }

      // Ckeditor integration to textarea.
      CKEDITOR.replace('description');

   })
</script>
@endsection