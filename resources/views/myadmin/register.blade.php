@extends('myadmin.layouts.app')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile">
        <div class="x_title">
            <h2>@lang('titles.registerAdmin')</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a href="/admin/userlist" class="custom-btn">@lang('titles.adminUserList')</a></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form method="POST" action="{{ route('admin.register.submit') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group row">
                    <label for="fname" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-md-right">First Name</label>

                    <div class="col-md-4 col-sm-9 col-xs-12">
                        <input id="fname" type="text" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}"
                            name="fname" value="{{ old('fname') }}" required autofocus autoComplete="off">

                        @if ($errors->has('fname'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('fname') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lname" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-md-right">Last Name</label>

                    <div class="col-md-4 col-sm-9 col-xs-12">
                        <input id="lname" type="text" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}"
                            name="lname" value="{{ old('lname') }}" required autofocus autoComplete="off">

                        @if ($errors->has('lname'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('lname') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-md-right">E-Mail Address</label>

                    <div class="col-md-4 col-sm-9 col-xs-12">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" required autoComplete="off">

                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-md-right">Role</label>

                    <div class="col-md-4 col-sm-9 col-xs-12">

                        <select id="role" class="form-control" name="role" required>

                            <option value="">Select Role</option>
                            @if(count($roles)>0)

                            @foreach($roles as $role)

                            <option value="{{$role->id}}">{{$role->name}}</option>

                            @endforeach

                            @else

                            <p>No roles are defined.</p>
                            @endif
                        </select>

                        @if ($errors->has('role'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-md-right">Password</label>

                    <div class="col-md-4 col-sm-9 col-xs-12">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            name="password" required autoComplete="off">

                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-md-right">Confirm
                        Password</label>

                    <div class="col-md-4 col-sm-9 col-xs-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autoComplete="off">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection