@extends('dashboard.layout.index')
@section('content')
@section('style')
    <style>
        /* .ui-autocomplete {
            max-height: 400px !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }
        .ui-autocomplete{
            z-index:99999 !important;
        } */
        .ui-menu-divider {
            display: none;
        }
    </style>
@endSection
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="content-header">
            <div class="box-header">
                <h2 class="blue">
                    <i class="nav-icon fa fa-list"></i>
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
            <form id="list_product_form" method="post" class="custom_form" enctype="multipart/form-data" action="{{ route('purchase.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="text" name="date" id="podate" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reference_no">Reference No</label>
                            <input type="reference_no" name="reference_no" id="reference_no" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="add_item" name="add_item" id="add_item" placeholder="Please add products to order list" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="control-group table-group">
                            <label class="table-label">Order Items *</label>
                            <div class="controls table-controls">
                                <table id="poTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
                                    <thead>
                                        <tr>
                                            <th class="text-center col-8">Product (Code-Name)</th>
                                            <th class="text-center col-1">Unit Cost</th>
                                            <th class="text-center col-1">QTY</th>
                                            <th class="text-center col-1">Discount</th>
                                            <th class="text-center col-1">Sub Total (USD)</th>
                                            <th><i class="fa fa-trash" style="opacity:0.5; filter:alpha(opacity=50);"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot></tfoot>
                                </table>
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
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn_logo btn-sm">Add Purchase</button>
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
        jQuery('#podate').datetimepicker({
            format:'Y/m/d H:i',
            theme:'dark',
            value: new Date()
        });
        $('#product_details').summernote();

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        function generateCardNo(x) {
            if (!x) {
                x = 16;
            }
            chars = '1234567890';
            no = '';
            for (var i = 0; i < x; i++) {
                var rnum = Math.floor(Math.random() * chars.length);
                no += chars.substring(rnum, rnum + 1);
            }
            return no;
        }
        $('#random_num').click(function() {
        var code = generateCardNo(8);
            $(this)
                .parent('.input-group')
                .children('input')
                .val(code);
        });



        $("#add_item").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('purchase.suggestions') }}',
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

         
    });
    
</script>
@endSection