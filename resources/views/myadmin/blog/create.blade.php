@extends('myadmin.layouts.app')

@section('content')

    <h1>New Blog</h1>
    <div class="row">	
	    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><!--form for blog-->
		    <form action="{{route('blog.store')}}" method="post">
		    	{{ csrf_field() }}

		    	<div class="form-group">
				    
				    <input placeholder="Post Title" type="text" class="form-control input-lg" id="title" v-model="title" autocomplete="off">
				</div>

				<slug-widget url="{{url('/')}}" subdirectory="blog" :title="title" @slug-changed = "updateSlug"></slug-widget>

				<div style="margin-top: 20px;" class="form-group">
				  	
				  	<textarea placeholder="Compose your post.............." class="form-control" rows="10" id="body"></textarea>
				</div>
				<div class="form-group">
				  	
				  	<textarea placeholder="Excerpt" class="form-control" rows="3" id="excerpt"></textarea>
				</div>
		    </form>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

			<div class="panel panel-default">
		      	<div class="panel-heading">Publish</div>
		      	<div class="panel-body">
		      		<button class="btn btn-default pull-left btn_modified">Save Draft</button>
		      		<button class="btn btn-default pull-right btn_modified">Preview</button>
		      		
		      		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 blog_info">
		      			<br/>
		      			<p>
		      				<i class="fa fa-hourglass-2" aria-hidden="true"></i>&nbsp;&nbsp;Status: Draft <br/>
		      				<span style="padding-left:20px;">Saved a few minutes ago.</span>
		      			</p>
		      			<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;Publish: Immediately</p>

		      		</div>

		      		
		      	</div>
		      	<div class="panel-heading"></div>
		      	<div class="panel-body">
		      		<button class="btn btn-primary btn-block full-width btn_modified">Publish</button>
		      	</div>
		    </div>
		</div>
	</div>
          
@endsection

@section('scripts')
	<script>
		var app = new Vue({
			el: '#app',
			data:{
				title: '',
				slug: '',
				api_token: '{{Auth::user()->api_token}}'
			},
			methods: {
				updateSlug: function(val) {
					this.slug = val;
				}
			}
		});
	</script>
@endsection
