@extends('dashboard.layout.index')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="content-header">
            <div class="box-header">
                <h2 class="blue">
                    <i class="nav-icon {{ $icon }}"></i>
                    <?= $url ?>
                </h2>
            </div>
        </div>

        <div class="container-fluid pr-15 pl-15">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="smg_alert">
                        @if(Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if(Session::get('fail'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('fail') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form_user_create">
                <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-9 col-lg-9">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Create User</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Small boxes (Stat box) -->
                                    <div class="form_content_user_add">
                                        <div class="form_user_add">
                                            <div class="form-group">
                                                <label for="name"><i class="fa fa-user"></i> Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" aria-describedby="emailHelp">
                                                <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="email"><i class="fas fa-envelope-open-text"></i> Email address</label>
                                                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" aria-describedby="emailHelp">
                                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="email"><i class="fas fa-phone"></i> Mobile Number</label>
                                                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" data-inputmask-mask="(999) 999-9999">
                                                        <span class="text-danger">@error('mobile_number'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="password"><i class="fas fa-key"></i> Password</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                                                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="password_confirmation"><i class="fas fa-key"></i> Retype Password</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                                        <span class="text-danger">@error('password_confirmation'){{ $message }} @enderror</span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group"> --}}
                                                <button type="submit" class="btn btn-sm btn_logo"><i class="fas fa-user-plus"></i> Create User</button>
                                            {{-- </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-lg-3">

                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">User Role</h3>
                                </div>
                                <div class="card-body">
                                    <span class="text-danger">@error('user_role'){{ $message }} @enderror</span>
                                    @foreach($roles as $role)
                                        <div class="radio icheck-info">
                                            <input type="radio" name="user_role" value="{{ $role->name }}" id="supper_admin_{{ $role->id }}" />
                                            <label for="supper_admin_{{ $role->id }}">{{ $role->display_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- user avatar --}}
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">User Avatar</h3>
                                </div>
                                <div class="card-body">
                                    <input type="file" name="user_avatar" class="dropify" data-allowed-file-extensions="png jpeg jpg gif" data-height="100"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

@endSection
