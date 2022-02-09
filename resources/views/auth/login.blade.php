@extends('layouts.inc.index')
@section('styles')
<style type="">
    body  {
        background-image: url("{{ asset('assets/images/1.jpg') }}");
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
            <a href="{{ url()->current() }}" class="h1"><b>LOGIN</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('user.access.login') }}">
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
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
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
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn_logo btn-sm btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{-- <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div> --}}
            <!-- /.social-auth-links -->

            <p class="mb-1">
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection
