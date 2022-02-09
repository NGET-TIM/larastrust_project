@extends('layouts.inc.index')
@section('styles')
<style type="">
    body  {
        background-image: url("{{ asset('resources/assets/images/register.jpg') }}");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>
@endsection
@section('content')


<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ url()->current() }}" class="h1"><b>Register</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form method="POST" action="{{ route('user.access.register') }}">
                @csrf
                @if(Session::get('loggedout'))
                    <div class="alert alert-warning">
                        {{ Session::get('loggedout') }}
                    </div>
                @endif
                @if(Session::get('need_login'))
                    <div class="alert alert-warning">
                        {{ Session::get('need_login') }}
                    </div>
                @endif
                
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="name" class="form-control" placeholder="name" name="name" value="{{ old('name') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" value="{{ old('password') }}" id="password" name="password" autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="password confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" name="password_confirmation" autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <select id="user_role_id" class="block browser-default custom-select mt-1 w-full" name="role_id">
                        <option value="">Select As</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    @error('role_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                         I agree to the <a href="#">terms</a>
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                  </div>
                  <p class="mb-1">
                </p>
                <p class="mb-0">
                    <a class="text-center" href="{{ route('user.login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </p>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->


@endsection



