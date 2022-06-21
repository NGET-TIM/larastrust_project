<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('lang.site_name') ?> <?= isset($url) ? $url : '' ?></title>
    <link rel="shortcut icon" href="{{ asset('assets/images/new_.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= asset('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    {{-- <link rel="stylesheet" href="<?= asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>"> --}}
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= asset('assets/plugins/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/core.css') ?>">
    {{-- scss --}}
    <link rel="stylesheet" href="<?= asset('assets/flags/css/flag-icons.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= asset('assets/dist/css/adminlte.css')?>">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> --}}
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= asset('assets/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= asset('assets/plugins/summernote/summernote-bs4.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/plugins/select2/css/select2.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/plugins/sweetalert2/sweetalert2.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/plugins/toastr/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/plugins/icheck-bootstrap/skins/all.css') ?>">
    {{-- <link rel="stylesheet" href="<?= asset('assets/plugins/icheck-bootstrap/css/custom.css') ?>"> --}}
    <link rel="stylesheet" href="<?= asset('assets/plugins/dropzone/dropzone.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/plugins/dropify/css/dropify.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/plugins/jquery-datatables-checkboxes/css/dataTables.checkboxes.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/css/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bs-icon/bootstrap-icons.css') }}">
    @yield('style')


</head>
<body>
    <div id="loading">
        <div class="lds-ripple"><div></div><div></div></div>
    </div>
    <div id="ajax_loading" class="ajax_loading">
        <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>


    <div id="main">
		<div class="wrapper">
			@include('dashboard/layout/layout')
			@yield('content')


			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2020-2021 <a href="http://kh-store.epizy.com">TIM Dev</a></strong>
				All rights reserved.
				<div class="float-right d-none d-sm-inline-block">
					<b>Version</b> 3.1.0
				</div>
			</footer>

		</div>
	</div>

    <div class="modal_1"></div>
    <div class="modal_2"></div>
    <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
    <div class="modal fade in" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true"></div>
    <input type="hidden" value="{{ URL::to('') }}" id="base_url">



    <!-- jQuery -->
    <script src="<?= asset('assets/plugins/jquery/jquery.min.js')?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= asset('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="<?= asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- ChartJS -->
    <script src="<?= asset('assets/plugins/chart.js/Chart.min.js')?>"></script>
    <!-- Sparkline -->
    <script src="<?= asset('assets/plugins/sparklines/sparkline.js' )?>"></script>
    <!-- JQVMap -->
    {{-- <script src="<?= asset('assets/plugins/jqvmap/jquery.vmap.min.js')?>"></script> --}}
    {{-- <script src="<?= asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script> --}}
    <!-- jQuery Knob Chart -->
    <script src="<?= asset('assets/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
    <!-- daterangepicker -->
    <script src="<?= asset('assets/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= asset('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' )?>"></script>
    <!-- Summernote -->
    <script src="<?= asset('assets/plugins/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?= asset('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <script src="<?= asset('assets/plugins/inputmask/jquery.inputmask.min.js') ?>"></script>
    <script src="<?= asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
    <script src="<?= asset('assets/plugins/select2/js/select2.js') ?>"></script>
    <script src="<?= asset('assets/plugins/dropzone/dropzone.js') ?>"></script>
    <script src="<?= asset('assets/plugins/dropify/js/dropify.js') ?>"></script>
    <script src="<?= asset('assets/plugins/sweetalert2/sweetalert2.js') ?>"></script>
    <script src="<?= asset('assets/plugins/cookie/jquery.cookie.js') ?>"></script>
    <script src="<?= asset('assets/plugins/toastr/toastr.min.js') ?>"></script>

    {{-- <script src="<?= asset('assets/plugins/jquery-datatables-checkboxes/js/dataTables.checkboxes.js') ?>"></script> --}}
    <!-- overlayScrollbars -->
    <script src="<?= asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= asset('assets/dist/js/adminlte.js') ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= asset('assets/dist/js/demo.js') ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= asset('assets/dist/js/pages/dashboard.js') ?>"></script>
    <script src="<?= asset('js/main.js') ?>"></script>
    <script src="<?= asset('assets/plugins/bootstrap-datepicker/js/jquery.datetimepicker.full.js') ?>"></script>
    <script src="<?= asset('assets/plugins/bootbox/bootbox.all.js') ?>"></script>
    <script src="<?= asset('assets/plugins/icheck-bootstrap/js/icheck.js') ?>"></script>
    <script src="<?= asset('assets/plugins/icheck-bootstrap/js/custom.min.js') ?>"></script>
    <script src="<?= asset('assets/js/core.js') ?>"></script>

    <?php if($url == "add purchase") { ?>
        <script src="<?= asset('assets/js/purchase.js') ?>"></script>
    <?php } ?>
    <script>
        var site = <?=json_encode(array('base_url' => URL::to('')))?>;
        $.widget.bridge('uibutton', $.ui.button);
        $(function(){
		    $('input[type=text]').attr('autocomplete','off');
	    });


    </script>
    @yield('script')
</body>
</html>
