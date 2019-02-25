@extends('myadmin.layouts.app')

@section('content')
	<h1>The HolidayPlanner admin users</h1>
	<a href="/admin/register" class="btn btn-default">New User</a>

		@if($users)
			<table class="table table-striped">
			    <thead>
			      	<tr>
				        <th>Name</th>
				        <th>Email</th>
				        <th>Role</th>
				        <th>Photo</th>
			      	</tr>
			    </thead>
			    <tbody>
			    	
			    	@foreach ($users as $user)
				      	
				      	<tr  id="{{$user->id}}" onmouseover="showEditDelete(this.id,'{{$user->fname}}')" style="height:70px">
				      		
					        <td>
					        	{{$user->fname}} {{$user->lname}} 
					        	<br>

					        	<span class="show_edit_delete" id="{{$user->fname}}"><a href="#">Edit</a> | <a href="#">Trash</a></span>	
					        	
					        </td>
					        <td>{{$user->email}}</td>
					        <td>{{$user->name}}</td>
					        <td>{{$user->image}}</td>
					       	
				      	</tr>
				     
				      	
				    @endforeach 
				    
			    </tbody>
			</table>
			{{$users->links()}}
			
			
		@else 

			<p class="alert alert-warning">Users not found.</p>

		@endif
		
@endsection

	