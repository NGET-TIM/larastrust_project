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

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
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
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn_logo btn-sm btn-block">Email Password Reset Link</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection

