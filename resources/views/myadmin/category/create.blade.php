@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-5 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.addCategory')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <form id="create-category" class="form-horizontal form-label-left" method="POST" action="{{ route('admin.category.submit') }}">
               <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                     <input type="text" name="name" id="name" required="required" onKeyUp="createSlug(this.value)"
                        class="form-control col-md-7 col-xs-12" autoComplete="off">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Slug <span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                     <input type="text" id="category-slug" name="slug" required="required" class="form-control col-md-7 col-xs-12"
                        autoComplete="off">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Parent
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                     <select id="parent" name="parent" class="form-control">
                        <option value="">Select Parent</option>
                        @if(count($categories)>0)
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                        @else
                        <p>No Category are created yet.</p>
                        @endif
                     </select>
                  </div>
               </div>

               <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
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
<div class="col-md-7 col-sm-12 col-xs-12">
   <div class="x_panel tile">
      <div class="x_title">
         <h2>@lang('titles.addCategory')</h2>
         <div class="clearfix"></div>
      </div>
      <div class="x_content">

         <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <!-- <th>Description</th> -->
                     <th>Parent</th>
                     <th>Slug</th>
                     <th style="text-align:center;" width="80">Count</th>
                     <th style="text-align:center;" width="80">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(count($categories)>0)
                  <?php $count = 1; ?>
                  @foreach($categories as $category)
                  <tr>
                     <th scope="row">{{$count}}</th>
                     <td>{{$category->name}}</td>
                     <!-- <td>{{$category->description}}</td> -->
                     <td>@foreach($categories as $parentCategory)
                        @if($parentCategory->id == $category->parent_id)
                        {{$parentCategory->name}}
                        @endif
                        @endforeach</td>
                     <td>{{$category->slug}}</td>
                     <td style="text-align:center;">12</td>
                     <td style="text-align:center;"><i class="fa fa-trash"></i></td>
                  </tr>
                  <?php $count++;?>
                  @endforeach
                  @else
                  <tr>
                     <td colspan="7">No Category are created yet.</td>
                  </tr>
                  @endif

               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection
<script>
   function createSlug(name) {
      let slug = Slug(name);
      $("#category-slug").val(slug);
   }
</script>