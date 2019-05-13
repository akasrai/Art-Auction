@extends('layouts.app')

@section('content')
<div class="container" style="min-height:75vh">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <h3>
                            Create your Zorig Auction Account
                        </h3>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="col-md-12 no-padding">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="fname" class="col-form-label text-md-right">First Name</label>
                                    <input id="fname" type="text"
                                        class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}"
                                        name="fname" value="{{ old('fname') }}" required autofocus>

                                    @if ($errors->has('fname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="lname" class="col-form-label text-md-right">Last Name</label>
                                    <input id="lname" type="text"
                                        class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}"
                                        name="lname" value="{{ old('lname') }}" required autofocus>

                                    @if ($errors->has('lname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 no-padding">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="email" class="col-form-label text-md-right">E-Mail Address</label>
                                    <input id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="phone" class="col-form-label text-md-right">Phone Number</label>
                                    <input id="phone" type="number"
                                        class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        name="phone" value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 no-padding">
                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="password" class="col-form-label text-md-right">Password</label>
                                    <input id="password" type="password"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-form-label text-md-right">Confirm
                                        Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                &nbsp;&nbsp;&nbsp;Already have a account?<a class="btn btn-link"
                                    href="{{ route('login') }}">Sign in
                                    here.</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection