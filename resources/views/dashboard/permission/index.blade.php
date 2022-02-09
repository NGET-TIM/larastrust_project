@extends('dashboard.layout.index')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="content-header">
            <div class="box-header">
                <h2 class="blue">
                    <i class="nav-icon fa fa-list"></i>
                    <?= $url ?>
                </h2>

                <div class="box-icon remove_icon_dropleft">
                    <div class="btn-group dropleft">
                        <a type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon fa fa-tasks tip" data-placement="left" title="actions"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item btn_getModal_add_permission" href="{{ route('permission.modal.add') }}"><i class="nav-icon fa fa-plus"></i> Add Permission</a>
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
                    <div class="role_permissions_table">
                        <form id="list_permissions_form">
                            @csrf
                            <table class="table table-bordered custom_table" id="permissions_table">
                                <thead>
                                    <th style="width: 2%">
                                        <div class="checkbox icheck-info">
                                            <input type="checkbox" name="role_main_check" id="info_main">
                                            <label class="info_main" for="info_main"></label>
                                        </div>
                                    </th>
                                    <th style="width: 30%">Module Name</th>
                                    <th style="width: 50%">Display Name</th>
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
        $('#permissions_table').DataTable({
            processing:true,
            info:true,
            ajax:"{{ route('permissions.list') }}",
            "pageLength":10,
            "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
            columns:[
                {data: null, orderable:false, searchable:false,
                "render": function (data, type, row, meta) {
                        return checkbox(row.id);
                    }
                },
                {data:'name', name:'name'},
                {data:'display_name', name:'display_name'},
                {data:'created_at', name:'created_at'},
                {data:'actions', name:'actions', orderable:false, searchable:false},
            ]
        });
    });

    // get modal edit permissions
    $(document).on('click', '.btn_edit_permission', function(e) {
        e.preventDefault();
        var permission_id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: "{{ route('permission.modal.edit') }}",
            data: {
                permission_id: permission_id
            },
            success: function(response) {
                if (response.modal) {
                    $('.modal_1').html(response.modal).show();
                    $('#permission_modal_edit').modal('show');
                }
            }
        });
    });
    // get modal add permission
    $(document).on('click', '.btn_getModal_add_permission', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: "{{ route('permission.modal.add') }}",
            success: function(response) {
                if (response.modal) {
                    $('.modal_1').html(response.modal).show();
                    $('#permission_modal_add').modal('show');
                }
            }
        });
    });
</script>
@endSection