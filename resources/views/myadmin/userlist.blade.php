@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel tile">
		<div class="x_title">
			<h2>
				@lang('titles.adminUserList')
				<small>@lang('titles.adminUserListMsg')</small>
			</h2>
			<ul class="nav navbar-right panel_toolbox">
				<li><a href="/admin/register" class="custom-btn">@lang('titles.newAdmin')</a></a>
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
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

					<tr id="{{$user->id}}" onmouseover="showEditDelete(this.id,'{{$user->fname}}')" style="height:70px">

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
		</div>
	</div>
</div>

@endsection