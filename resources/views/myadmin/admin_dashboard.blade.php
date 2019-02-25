@extends('myadmin.layouts.app')

@section('content')

    <h1>Welcome admin</h1>
    	@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
            
@endsection
