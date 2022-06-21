@extends('dashboard.layout.index')
@section('style')
    <style>
        fieldset.scheduler-border {
            border: 1px solid #DBDEE0 !important;
            padding: 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
        }
        legend.scheduler-border {
            font-size: 1.1em !important;
            font-weight: bold !important;
            text-align: left !important;
            width: auto;
            color: #42B883;
            padding: 5px 15px;
            border: 1px solid #DBDEE0 !important;
            margin: 0;
        }
    </style>
@endSection
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
                            <a class="dropdown-item" href="{{ route('setting.table.create') }}" id="add_table"><i class="nav-icon fa fa-plus"></i> {{ __('lang.add_table') }}</a>
                            <a class="dropdown-item delete_categories_checked"><i class="nav-icon fa fa-trash"></i> {{ __('lang.delete_table') }}</a>
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
                        <form id="list_table_form">
                            @csrf
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">{{__('lang.site_configuration')}}</legend>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="site_name">{{__('lang.site_name')}}</label>
                                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ NT::Settings()->site_name }}"/>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="site_name">{{__('lang.site_name')}}</label>
                                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ NT::Settings()->site_url }}"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
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



    });
</script>
@endSection
