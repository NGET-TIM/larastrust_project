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
                            <a class="dropdown-item add_customer" href="{{ route('customer.add') }}"><i class="nav-icon fa fa-plus"></i> {{ __('lang.add_customer') }}</a>
                            @if(Auth::user()->hasRole(['supper-admin', 'admin']))
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_customers_checked"><i class="nav-icon fa fa-trash"></i> {{ __('lang.delete_customer') }}</a>
                            @endif
                            
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
                        <form id="list_products_table_form" method="post" class="custom_form" enctype="multipart/form-data" action="{{ route('product.actions') }}">
                            @csrf
                            <table class="table_list_items table table-bordered custom_table" id="customer_table">
                                <thead>
                                    <th style="width: 2%">
                                        <input type="checkbox" class="checkbox checkth" name="check" id="check_all">
                                    </th>
                                    <th style="width: 60%">{{ __('lang.full_name') }}</th>
                                    <th style="width: 25%">{{ __('lang.phone') }}</th>
                                    <th style="width: 10%">{{ __('lang.gender') }}</th>
                                    <th style="width: 5%">{{ __('lang.actions') }}</th>
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
        table = $('#customer_table').DataTable({
            processing:true,
            info:true,
            ajax:"{{ route('customer.list') }}",
            "pageLength":5,
            "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
            createdRow: function (row, data, index) {
                row.id = data.id;
                row.className = "customer_link";
                return row;
            },
            columns:[
                {data: null,orderable:false, searchable:false,
                    "render": function (data, type, row, meta) {
                        return checkbox(row.id);
                    }
                },
                {data:'name', name:'name'},
                {data:'phone', name:'phone'},
                {data:'gender', name:'gender'},
                {data:'actions', name:'actions', orderable:false, searchable:false},
            ]
        });
        

        


        // delete product
        $(document).on('click','.delete_product', function (e) {
            e.preventDefault();
            var product_id = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure ?',
                html: "You want to <b>delete</b> this product!",
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
                        url: "{{ route('product.delete') }}",
                        data: {
                            product_id: product_id
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
                                    $('#customer_table').DataTable().ajax.reload(null, false);
                                });
                            }
                            if (response.success == 0) {
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
                                    $('#customer_table').DataTable().ajax.reload(null, false);
                                });
                            }
                        }
                    });
                }
            });
        });
        $(document).on('click', '.delete_products_checked', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete seleted products!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                allowOutsideClick: false,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('products.checked.delete') }}",
                        data: $('#list_products_table_form').serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: response.icon,
                                    title: response.status,
                                    text: response.status_text,
                                    button: "OK",
                                    allowOutsideClick: false,
                                }).then((confirmed) => {
                                    $('#customer_table').DataTable().ajax.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
        // modal add more gallery for product
        $(document).on('click', '.add_customer', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: "{{ route('customer.add') }}",
                success: function(response) {
                    if (response.modal) {
                        $('.modal_1').html(response.modal).show();
                        $('#modal_add_customer').modal('show');
                    }
                }
            });
        });
        $(document).on('click', '.product_link td:not(:first-child, :last-child)', function(e) {
            e.preventDefault();
            var product_id = $(this).closest('tr').attr('id');
            $.ajax({
                type: 'GET',
                url: "{{ route('product.modal_view_product') }}",
                data: {
                    product_id: product_id
                },
                success: function(response) {
                    if (response.modal) {
                        $('.modal_1').html(response.modal).show();
                        $('#modal_view_product').modal('show');
                    }
                }
            });
        });
    });
</script>
@endSection