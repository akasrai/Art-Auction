@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-9 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.addProduct')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <form id="create-category" method="POST" action="{{ route('admin.category.submit') }}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <input type="text" name="name" id="name" v-model="title" required="required" class="form-control col-md-7 col-xs-12"
                        autoComplete="off" placeholder="Name">
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <!-- <slug-widget url="{{url('/')}}" subdirectory="product" :title="title" @slug-changed="updateSlug"></slug-widget> -->
                     @include('myadmin.inc.slugwidget')
                  </div>
               </div>
               <div class="form-group col-md-6 col-sm-12 col-xs-12">
                  <label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Slug <span class="required">*</span>
                  </label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <input type="text" id="slug" name="slug" required="required" class="form-control col-md-7 col-xs-12"
                        autoComplete="off">
                  </div>
               </div>
               <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <label for="middle-name" class="control-label col-md-12 col-sm-12 col-xs-12">Description</label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <textarea id="description" class="form-control col-md-7 col-xs-12" type="text" name="description"></textarea>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                     <button class="btn btn-primary" type="reset">Reset</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
   <div class="panel panel-default">
      <div class="panel-heading">@lang('titles.publish')</div>
      <div class="panel-body">
         <button class="btn btn-primary pull-left btn_modified">Publish</button>
         <button class="btn btn-default pull-right btn_modified">Preview</button>
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_info">
            <br />
            <p>
               <i class="fa fa-hourglass-2" aria-hidden="true"></i>&nbsp;&nbsp;Status: Draft <br />
               <span style="padding-left:20px;">Saved a few minutes ago.</span>
            </p>
            <p><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;Publish: Immediately</p>

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
               <input id="" type="checkbox" value="{{$category->id}}">
               <label for="">
                  {{$category->name}}
               </label>
            </div>
            @endforeach
            @else
            <p>No Category are created yet.</p>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
   // var app = new Vue({
   //    el: '#app',
   //    data: {
   //       title: '',
   //       slug: '',
   //       api_token: '{{Auth::user()->api_token}}',
   //       controller: 'product'
   //    },
   //    methods: {
   //       updateSlug: function(val) {
   //          this.slug = val;
   //       }
   //    }
   // });
   window.Laravel.apiToken = '{{Auth::user()->api_token}}';
</script>
@endsection