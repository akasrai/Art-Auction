@extends('myadmin.layouts.app')

@section('content')

    <h1>Blogs</h1>
    	<a href="/admin/blog/create" class="btn btn-info pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> New blog</a>
    	
    	@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <articles></articles>
          
@endsection