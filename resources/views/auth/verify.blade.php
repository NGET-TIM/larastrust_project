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
            <a href="{{ url()->current() }}" class="h1"><b>{{ __('Reset Password') }}</b></a>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Verify Your Email Address</div>
                              <div class="card-body">
                               @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                       {{ __('A fresh verification link has been sent to your email address.') }}
                                   </div>
                               @endif
                               <a href="/{{$token}}/reset-password">Click Here</a>.
                           </div>
                       </div>
                   </div>
               </div>
           </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection


