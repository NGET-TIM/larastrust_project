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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
            <form class="custom_form" method="POST" enctype="multipart/form-data" action="{{ url('admin/category/update') }}/{{ $category->id }}">
                @csrf
                <div class="row">
                    <div class="col-6 col-lg-6 offset-3">
                        
                        <div class="form-group">
                            <label for="code">Code <span class="star_required">*</span></label>
                            <input type="text" class="form-control" name="code" id ="code" value="{{ $category->code }}">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                           
                        </div>
                        <div class="form-group">
                            <label for="name">Name <span class="star_required">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12 col-lg-12">
                        <a href="{{ route('category.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                        <button type="submit" class="btn btn_logo btn-sm">Update Category</button>
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
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        
    });
</script>
@endSection