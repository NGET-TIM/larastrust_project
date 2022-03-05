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
            <form id="list_product_form" method="post" class="custom_form" enctype="multipart/form-data" action="{{ route('product.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6 col-lg-6">
                        <div class="form-group">
                            <label for="name">Product Name <span class="star_required">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="code">Product Code <span class="star_required">*</span></label>
                            <input type="text" class="form-control" name="code" id ="code" value="{{ old('code') }}">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group all">
                            <label for="code">Code <span class="icon_required">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" placeholder="Click the right button to generate barcode and select the correct symbology here">
                                {{-- <span class="input-group-addon pointer" id="random_num" style="padding: 1px 10px;">
                                    <i class="fa fa-random"></i>
                                </span> --}}
                                <div class="input-group-append" id="random_num">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-random"></i></span>
                                </div>
                            </div>
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight <span class="star_required"></span></label>
                            <input type="text" class="form-control" name="weight" id ="weight" value="{{ old('weight') }}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6 col-lg-6">
                                    <label for="category_id">Category <span class="star_required">*</span></label>
                                    <select name="category_id" id="category_id" class="select">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }} - ( {{ $category->code }} )</option>4
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-lg-6">
                                    <label for="brand_id">Brand <span class="star_required"></span></label>
                                    <select name="brand_id" id="brand_id"  class="select">
                                        <option value="">Select Brand</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6 col-lg-6">
                                    <label for="cost">Cost <span class="star_required"></span></label>
                                    <input type="text" class="form-control" name="cost" id ="cost" value=" {{ old('cost') }}">
                                    @error('cost')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-lg-6">
                                    <label for="price">Price <span class="star_required">*</span></label>
                                    <input type="text" class="form-control" name="price" id ="price" value="{{ old('price') }}">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- right section --}}
                    <div class="col-6 col-lg-6">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6 col-lg-6">
                                    <label for="coquantityst">Quantity <span class="star_required"></span></label>
                                    <input type="text" class="form-control" name="quantity" id ="quantity" value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-lg-6">
                                    <label for="quantity_alert">Quantity Alert <span class="star_required"></span></label>
                                    <input type="text" class="form-control" name="quantity_alert" id ="quantity_alert" value="{{ old('quantity_alert') }}">
                                    @error('quantity_alert')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Single image <span class="star_required"></span></label>
                            <input type="file" class="dropify" data-height="110" name="image" id="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image_gallery">
                                <div class="checkbox icheck-info">
                                    <input type="checkbox" class="checkbox checkth" value="1" name="check">
                                    <label class="info_main" for="info_main">Product Gallery ?</label>
                                </div>
                            </label>
                            <div class="product_gallery_dropify">
                                <input type="file" class="dropify" data-height="110" name="image_gallery[]" id="image_gallery" multiple>
                                @error('image_gallery')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @money(1253.55)  --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Product Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <textarea id="product_details" name="product_details">{{ old('product_details') }}</textarea>                                                                                    </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn_logo btn-sm">Add Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

@endSection
@section('script')
<script>
    $(document).ready(function() {
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
    });
</script>
@endSection