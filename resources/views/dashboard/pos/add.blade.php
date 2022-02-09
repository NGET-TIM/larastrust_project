@extends('dashboard.layout.pos')
@section('content')
@section('style')
    <style>
        .ui-menu-divider {
            display: none;
        }
        #main {
            height: 100vh;
        }
        .order_items_content {
            height: 50vh;
        }
        .content_wrapper_pos {
            padding-top: 2vh;
        }
        .content-wrapper,
        .main-header {
            margin-left: 0 ! important;
        }
        .right_content {
            border-left: 1px solid #abb;
        }
        .left_content .card-body {
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            cursor: pointer;
        }
        .left_content .card-body img {
            width: 100%;
            max-height: 90px;
            transition: .3s ease-in-out;
        }
        .left_content .card-header {
            font-size: 12px;
        }
        .left_content .card-body {
            border: 1px solid #14a7b4b8;
        }
        .card_popup {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #14a7b4b8;
            color: #fff;
            font-size: 12px;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis; 
            padding: 5px;
            z-index: 10;
            cursor: pointer;
        }
        #ajaxProducts .card-body:hover img {
            transform: scale(1.1);
            transition: .3s ease-in-out;
        }
        #prModal .modal-title {
            color: #14a7b4 !important;
        }
        .custom_group .select2 {
            width: 78% !important;
        }
        #table_items {
            height: 360px;
            overflow: hidden;
            overflow-y: auto;
        }
    </style>
@endSection
<!-- Content Wrapper. Contains page content -->
<div class="content_wrapper_pos">
    <section class="content_pos">
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
            <form id="list_product_form" method="post" class="custom_form" enctype="multipart/form-data" action="{{ route('pos.store') }}">
                @csrf
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
                            @error('customer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7 left_content">
                        <div class="row" id="ajaxProducts">
                            @if($products)
                                @foreach($products as $key => $product)
                                    <div class="col-2">
                                        <div class="card">
                                            <div class="card_popup product" data-id="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</div>
                                            <div class="card-body product" data-id="{{ $product->id }}"><img src="{{ url('') .'/'.($product->image != "upload/images/product/ " ? $product->image : 'upload/images/product/main-logo.png') }}" class="rounded img-responsive" alt="TIM Dev"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="paginator">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 pl-15 right_content">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="customer">{{ __('lang.customer') }}</label>
                                    <select name="customer" id="customer"  class="select">
                                        <option value="">{{ __('lang.select_customer') }}</option>
                                        <option value="1">Customer A</option>
                                        <option value="2">Customer B</option>
                                        <option value="3">Customer C</option>
                                        <option value="4">Customer D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="podate">{{ __('lang.date') }}</label>
                                    <input type="text" name="date" id="podate" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                    <div class="form-group">
                                        <label for="select_table">{{ __('lang.table') }}</label>
                                        <div class="input-group custom_group">
                                            <select disabled name="select_table" id="select_table"  class="select">
                                                <option value="">{{ __('lang.please_select_table') }}</option>
                                                @if($tables)
                                                    @foreach($tables as $table)
                                                        <option value="{{ $table->id }}">{{ $table->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        <div class="input-group-append" id="show_table">
                                            <a class="btn btn-ms btn_logo"><i class="fas fa-table"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-cart-arrow-down"></i></span>
                                    </div>
                                    <input type="add_item" name="add_item" id="add_item" placeholder="Please add products to order list" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="order_items_content">
                                    <div class="control-group table-group">
                                        <label class="table-label">{{ __('lang.order_items') }}</label>
                                        <div class="controls table-controls" id="table_items">
                                            <table id="poTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center col-6">{{  __('lang.product_code_name')  }}</th>
                                                        <th class="text-center col-1">{{ __('lang.price') }}</th>
                                                        <th class="text-center col-1">{{ __('lang.qty') }}</th>
                                                        <th class="text-center col-1">{{ __('lang.discount') }}</th>
                                                        <th class="text-center col-2">{{ __('lang.sub_total') }} (USD)</th>
                                                        <th class="text-center col-1"><i class="fa fa-trash" style="opacity:0.5; filter:alpha(opacity=50);"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot></tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order_tax">Order Tax</label>
                                    <select name="order_tax" id="order_tax"  class="select">
                                        <option value="">No Tax</option>
                                        <option value="">VAT @ 10%</option>
                                        <option value="">GST @ 6%</option>
                                        <option value="">VAT @ 20%</option>
                                        <option value="">COP @ 7%</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order_discount">Order Discount(5/5%)</label>
                                    <input type="order_discount" name="order_discount" id="order_discount" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_term">Payment Term</label>
                                    <select name="payment_term" id="payment_term"  class="select">
                                        <option value="">No Payment Term</option>
                                        <option value="">3 Days</option>
                                        <option value="">5 Days</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="btn-group btn-block btn-group-ms">
                                    <button type="button" class="btn btn-danger"><i class="custom_icon bi bi-trash"></i>{{ __('lang.cancel') }}</button>
                                    <button type="button" class="btn btn-warning"><i class="custom_icon bi bi-save-fill"></i>{{ __('lang.suspend') }}</button>
                                    <button type="submit" class="btn btn-success">
                                        <span class="spinner-grow spinner-grow-sm"></span>
                                        {{ __('lang.payment') }}
                                    </button>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
</div>

{{-- modal edit item --}}
<div class="modal" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="prModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <table class="table">
                        <tr>
                            <td>
                                <label for="pqty">Quantity</label>  
                            </td>
                            <td>
                                <input type="text" class="form-control" name="pqty" id="pqty">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="product_discount">Product Discount</label>  
                            </td>
                            <td>
                                <input type="text" class="form-control" name="product_discount" id="product_discount">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="unit_cost">Unit Cost</label>  
                            </td>
                            <td>
                                <input type="text" class="form-control" name="unit_cost" id="unit_cost">
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="punit_price" value=""/>
                    <input type="hidden" id="old_tax" value=""/>
                    <input type="hidden" id="old_qty" value=""/>
                    <input type="hidden" id="old_price" value=""/>
                    <input type="hidden" id="row_id" value=""/>
                    <input type="hidden" id="item_id" value=""/>
					
                </form>
								
				<div class="clearfix"></div>
			
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editItem">Submit</button>
            </div>
        </div>
    </div>
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

        $("#add_item").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('pos.suggestions') }}',
                    dataType: "json",
                    data: {
                        term: request.term,
                        supplier_id: $("#posupplier").val(),
						warehouse_id: $("#powarehouse").val()
                    },
                    success: function (data) {
                        $(this).removeClass('ui-autocomplete-loading');
                        response(data);
                    }
                });
            },
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
            },
			
			select: function (event, ui) {
                event.preventDefault();
				if (ui.item.id !== 0) {
					var row = add_invoice_item(ui.item);
                    if (row)
                        $(this).val('');
                } else {
                    alert('No');
                }
				
            }

        });

        // products click
        $(document).on('click', '#ajaxProducts .card .product', function() {
            var product_id = $(this).data('id');
            var image = $(this).closest('.card').find("img").eq(0);
            getItem(product_id, image);
        });
        function getItem(product_id, image) {
            $.ajax({
                type: "get",
                url: '{{ route('pos.click_product') }}',
                data: {product_id: product_id},
                dataType: "json",
                success: function (data) {
                    if (data !== null) {
						if (data.id !== 0) {
							var row = add_invoice_item(data);
                            cloneItem(data.row.code, image);
								if (row)
									$(this).val('');
						} else {
							bootbox.alert('no_match_found');
						}
                        $('#modal-loading').hide();
                    } else {
                        bootbox.alert('no_match_found');
                        $('#modal-loading').hide();
                    }
                }
            });
        }

        function cloneItem(product_code, image) {
            console.log("product_code: "+ product_code);
            var s = $("#poTable tbody tr .product_code_"+product_code+":last-child:visible"),
                i = image;
            if (i) {
                var a = i.clone()
                    .offset({ top: i.offset().top, left: i.offset().left })
                    .css({ opacity: "0.5", position: "absolute", height: "150px", width: "150px", "z-index": "1060" })
                    .appendTo($("body"))
                    .animate({ top: s.offset().top + 10, left: s.offset().left + 10, width: "50px", height: "50px", "border-radius": "10px" }, 500);
                    a.animate({ width: 0, height: 0 }, function() { $(this).detach() });
                    s.animate({ fontSize: '9px'}, 100).animate({ fontSize: '1em'}, 150);
            }
        }

        // load ajax with pagnation
        // $(document).on('click', '.paginator .pagination li a', function (e) {
        //     e.preventDefault();
        //     $('.paginator .pagination li').removeClass('active');
        //     $(this).closest('li').addClass('active');
        //     var page = $(this).attr('href').split('page=')[1];
        //     var if_span = $('.paginator .pagination li span.page-link').text();
        //     $(this).closest('li').html(`<a class="page-link" href="${page}">${if_span}</a>`);
        //     loadProducts(page);
        // });

         
    });

    function loadProducts(page) {
        // var page_number = {{ session('page_number') }};
        var url = '{{ route('pos.create') }}/?page='+page;
        $.ajax({
            type: 'get',
            url: '{{ route('pos.get_product') }}/?page='+page,
            dataType: "json",
            success: function (products) {
                window.history.pushState('', '', url);
                $('#ajaxProducts').html(products.html);
            }
        });
    }
    // loadProducts({{ config('product.paginate') }});
    
</script>
@endSection