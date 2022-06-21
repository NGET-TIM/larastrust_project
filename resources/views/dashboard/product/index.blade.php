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
                            <a class="dropdown-item" href="{{ route('product.add') }}"><i class="nav-icon fa fa-plus"></i> Add Product</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn_expor_excels" href="{{ route('product.export_excel') }}"><i class="nav-icon fa fa-file-excel"></i> {{ __('lang.expor_excel') }} </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item btn_export_pdf" ><i class="nav-icon fa fa-file-pdf"></i> {{ __('lang.export_pdf') }} </a>
                            @if(Auth::user()->hasRole(['supper-admin', 'admin']))
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_products_checked"><i class="nav-icon fa fa-trash"></i> Delete Products</a>
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
                            {{ route('test', ['id' => 1]) }}
                            <table class="table_list_items table table-bordered custom_table" id="product_table">
                                <thead>
                                    <th style="width: 2%">
                                        <input type="checkbox" class="checkbox checkth" name="check" id="check_all">
                                    </th>
                                    <th style="width: 5%">Image</th>
                                    <th style="width: 10%">Code</th>
                                    <th style="width: 10%">ID</th>
                                    <th style="width: 25%">Name</th>
                                    <th style="width: 5%">Quantity</th>
                                    <th style="width: 10%">Category</th>
                                    <th style="width: 10%">Created At</th>
                                    @if(Auth::user()->hasRole(['supper-admin', 'admin']))
                                        <th style="width: 15%">Created By</th>
                                    @endif
                                    <th style="width: 5%">Actions</th>
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
        table = $('#product_table').DataTable({
            processing:true,
            info:true,
            ajax:"{{ route('product.list') }}",
            "pageLength":5,
            "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
            createdRow: function (row, data, index) {
                row.id = data.id;
                row.className = "product_link";
                return row;
            },
            columns:[
                {data: null,orderable:false, searchable:false,
                    "render": function (data, type, row, meta) {
                        return checkbox(row.id);
                    }
                },
                {data:'product_image', name:'product_image'},
                {data:'code', name:'code'},
                {data:'product_id', name:'product_id'},
                {data:'name', name:'name'},
                {data:'quantity', name:'quantity', className: "text-center"},
                {data:'category_name', name:'categories.category_name', className: "text-center"},
                {data:'created_at', name:'created_at'},
                @if(Auth::user()->hasRole(['supper-admin', 'admin']))
                    {data:'created_by', name:'created_by'},
                @endif
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
                                    $('#product_table').DataTable().ajax.reload(null, false);
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
                                    $('#product_table').DataTable().ajax.reload(null, false);
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
                                    $('#product_table').DataTable().ajax.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
        // modal add more gallery for product
        $(document).on('click', '.add_product_gallery', function(e) {
            e.preventDefault();
            var product_id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: "{{ route('product.modal.add.gallery') }}",
                data: {
                    product_id: product_id
                },
                success: function(response) {
                    if (response.modal) {
                        $('.modal_1').html(response.modal).show();
                        $('#modal_add_gallery').modal('show');
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
                        $('#modal_view_product').on('show.bs.modal', function() {
                            $('#modal_view_product .modal-body .getLoading').html(`
                                <div class="loading_content">
                                    <div class="lds-ring">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            `);
                        });

                        $('#modal_view_product').modal('show');
                        setTimeout(function() {
                            $('#modal_view_product .modal-body').find('.loading_content').fadeOut();
                        }, 500)
                    }
                }
            });
        });
    });
</script>
@endSection
