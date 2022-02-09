@extends('dashboard.layout.index')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="content-header">
            <div class="box-header">
                <h2 class="blue">
                    <i class="nav-icon fa fa-list"></i>
                    <?= $url == 'users' ? $url : '' ?>
                </h2>

                <div class="box-icon remove_icon_dropleft">
                    <div class="btn-group dropleft">
                        <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon fa fa-tasks tip" data-placement="left" title="actions"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('create') }}"><i class="nav-icon fa fa-plus"></i> Add User</a>
                            <a class="dropdown-item delete_users_checked"><i class="nav-icon fa fa-trash"></i> Delete Users</a>
                        </div>
                    </div>
                </div>
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

            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Users List</h3>
                            <a href="{{ route('create') }}" class="btn btn-xs btn_logo fl-r">
                                <i class="nav-icon fa fa-plus"></i> Add User
                            </a>
                        </div>
                        <div class="card-body">
                            <form id="list_users_form">
                                @csrf
                                <table class="table table-bordered custom_table" id="users_table">
                                    <thead>
                                        <th style="width: 2%">
                                            <div class="checkbox icheck-info">
                                                <input type="checkbox" name="category_main_check" id="info_main">
                                                <label class="info_main" for="info_main"></label>
                                            </div>
                                        </th>
                                        <th style="width: 40%">Name</th>
                                        <th style="width: 30%">E-mail</th>
                                        <th style="width: 10%">Role</th>
                                        <th style="width: 10%">Created</th>
                                        <th style="width: 5%">Actions <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete All</button></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        $('#users_table').DataTable({
            processing:true,
            info:true,
            ajax:"{{ route('user.list') }}",
            "pageLength":10,
            "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
            columns:[
                {data: null, orderable:false, searchable:false,
                    "render": function (data, type, row, meta) {
                        return checkbox(row.id);
                    }
                },
                {data:'name', name:'users.name'},
                {data:'email', name:'users.email'},
                {data:'role_label', name:'role_label'},
                {data:'date_time', name:'date_time'},
                {data:'actions', name:'actions', orderable:false, searchable:false},
            ]
        });
        // delete user by ajax
        $(document).on('click','.delete_user', function (e) {
            e.preventDefault();
            var user_id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure ?',
                html: "You want to <b>delete</b> this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false,
                confirmButtonText: 'Yes, comfirm it!' 
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('user.delete') }}",
                        data: {
                            user_id: user_id
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                var toastMixin = Swal.mixin({
                                    toast: true,
                                    icon: response.icon,
                                    position: 'top-right',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                });
                                toastMixin.fire({
                                    animation: true,
                                    title: response.msg
                                }).then((result) => {
                                    $('#users_table').DataTable().ajax.reload(null, false);
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endSection