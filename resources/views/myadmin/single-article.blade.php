@extends('myadmin.layouts.app')

@section('content')

    	@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <br>

        <singlearticle article-id="{{ $id }}">

        </singlearticle>
          
@endsection
