@extends('myadmin.layouts.app')

@section('content')

    <h1>Welcome Super Admin</h1>
    	@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <articles></articles>
          
@endsection
