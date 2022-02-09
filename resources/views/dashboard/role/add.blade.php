@extends('dashboard.layout.index')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="content-header">
            <div class="box-header">
                <h2 class="blue">
                    <i class="nav-icon fa fa-edit"></i>
                    <?= $url ?>
                </h2>

                <div class="box-icon remove_icon_dropleft">
                    <div class="btn-group dropleft">
                        <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon fa fa-tasks tip" data-placement="left" title="actions"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('create') }}"><i class="nav-icon fa fa-plus"></i> Add Role</a>
                            <a class="dropdown-item delete_users_checked"><i class="nav-icon fa fa-trash"></i> Delete Roles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('role.permissions.create') }}" method="post" enctype="multipart/form-data" id="role_permissions_table">
            @csrf
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
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Role Module Name</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-4">
                                            <label for="name">Module Name *</label>
                                            <input type="text" class="form-control get_value" readonly placeholder="This will be the code-name" name="name" id="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-4">
                                            <label for="display_name">Display Name</label>
                                            <input type="text" class="form-control generated_display_name" name="display_name" id="display_name" value="{{ old('display_name') }}">
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-4">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                            {{-- <input type="text" class="form-control" name="description" id="description" value="{{ $roles->description }}"> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Please set group permissions below</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered custom_table" id="roles_permissions_table">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="text-center">Group Permissions</th>
                                        </tr>
                                        <tr>
                                            <th rowspan="2" class="text-center">Module Name </th>
                                            <th colspan="5" class="text-center">Permissions</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">View</th>
                                            <th class="text-center">Add</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Delete</th>
                                            <th class="text-center">Miscellaneous</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td colspan="4">
                                                <div class="checkbox icheck-info">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="info_main_{{ $permission->id }}" >
                                                    <label class="info_main" for="info_main_{{ $permission->id }}">{{ $permission->display_name }}</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="btn-group" role="group" aria-label="btn" style="margin-top: 15px">
                                    <button type="submit" class="btn btn_logo " type="button">Add Role Permissions</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<!-- /.content-wrapper -->

@endSection
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('change keyup','.generated_display_name',function (e) { 
            $this_val = $(this).val();
            var strings = $this_val.toLowerCase();  
            strings = strings.split(' ').join('-');  
            $('.get_value').val(strings);
        });
    });

</script>
@endSection
