<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($url) ? $url : '' ?></title>
    <link rel="shortcut icon" href="{{ asset('assets/images/main-logo.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
    <!-- iCheck -->
    {{-- <link rel="stylesheet" href="<?php echo asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>"> --}}
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/css/core.css') ?>">
    {{-- scss --}}
    <link rel="stylesheet" href="<?php echo asset('assets/flags/css/flag-icons.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo asset('assets/dist/css/adminlte.css')?>">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"> --}}
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/summernote/summernote-bs4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/select2/css/select2.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/sweetalert2/sweetalert2.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/toastr/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/icheck-bootstrap/skins/all.css') ?>">
    {{-- <link rel="stylesheet" href="<?php echo asset('assets/plugins/icheck-bootstrap/css/custom.css') ?>"> --}}
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/dropzone/dropzone.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/dropify/css/dropify.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('assets/plugins/jquery-datatables-checkboxes/css/dataTables.checkboxes.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/main.css') ?>">
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
        <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">{{ __('lang.home') }}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">{{ __('lang.dashboard') }}</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="http://localhost/laravel_8/resources/assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="http://localhost/laravel_8/resources/assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas
                          fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="http://localhost/laravel_8/resources/assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All
                    Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tip" href="{{ route('pos.create') }}" data-placement="bottom" href="#" data-original-title="<?= __('lang.add_pos_sale') ?>" role="button">
                <i class="fa fa-cart-arrow-down"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tip white" title="" data-placement="bottom" id="clearLS" href="#" data-original-title="Clear all locally saved data" tabindex="-1">
                <i class="fa fa-eraser"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle tip" data-placement="top" title="{{ __('lang.switch_lang') }}" href="#"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a>
                @endif
            @endforeach
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link tip" data-toggle="dropdown" data-placement="top" title="{{ __('lang.switch_theme') }}" id="btn_toggle_theme" href="#">
                <i class="fab fa-500px"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ __('lang.select_theme') }}</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item btn_select_theme_color" id="style_standard">
                    <span class="float-right color_box standard_color text-sm"></span>
                    {{ __('lang.default') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item btn_select_theme_color" id="style_purple">
                    <span class="float-right color_box purple_color text-sm"></span>
                    {{ __('lang.purple') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item btn_select_theme_color" id="style_blue">
                    <span class="float-right color_box blue_color text-sm"></span>
                    {{ __('lang.blue') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item btn_select_theme_color" id="style_pink">
                    <span class="float-right color_box pink_color text-sm"></span>
                    {{ __('lang.pink') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item btn_select_theme_color" id="style_flat_red">
                    <span class="float-right color_box flat_red_color text-sm"></span>
                    {{ __('lang.flat_red') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item btn_select_theme_color" id="style_green">
                    <span class="float-right color_box green_color text-sm"></span>
                    {{ __('lang.green') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item btn_select_theme_color" id="style_dark">
                    <span class="float-right color_box dark_color text-sm"></span>
                    {{ __('lang.dark') }}
                </a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <div class="user_image_left_site">
                    <?php if(Auth::user()->avatar != '') { ?>
                        <img src="{{ url('/') }}/{{ Auth::user()->avatar }}" class="img-responsive" alt="">
                    <?php } else { ?>
                        <i class="far fa-user"></i>
                    <?php } ?>
                </div>

                {{ Auth::user()->name }}
                <span class="fas fa-angle-down"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ Auth::user()->name }}</span>
                <div class="dropdown-divider"></div>
                <a href="{{ url('admin/user/profile') }}/{{ Auth::user()->id }}" class="dropdown-item">
                    <i class="fa fa-user mr-2"></i>Profile </span>
                    {{-- <span class="float-right text-muted text-sm"> You are "{{ Auth::user()->roles }}" --}}
                </a>
                @if(Auth::user()->isAbleTo(['users-create', 'users-update', 'users-delete', 'Testing-Permissions']))
                    <a href="{{ URL::to('admin/dashboard/user/profile') }}/{{ Auth::user()->id }}/#change_password" class="dropdown-item">
                        <i class="fa fa-key mr-2"></i> Change Password
                    </a>
                @endif
                <a class="dropdown-item change_avatar_manual" data-user-id="{{ Auth::user()->id }}">
                    <i class="fa fa-edit mr-2"></i> Change Avatar
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
		@yield('content')
	</div>

    <div class="modal_1"></div>
    <div class="modal_2"></div>
    <input type="hidden" value="{{ URL::to('') }}" id="base_url">



    <!-- jQuery -->
    <script src="<?php echo asset('assets/plugins/jquery/jquery.min.js')?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo asset('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="<?php echo asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- ChartJS -->
    <script src="<?php echo asset('assets/plugins/chart.js/Chart.min.js')?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo asset('assets/plugins/sparklines/sparkline.js' )?>"></script>
    <!-- JQVMap -->
    {{-- <script src="<?php echo asset('assets/plugins/jqvmap/jquery.vmap.min.js')?>"></script> --}}
    {{-- <script src="<?php echo asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script> --}}
    <!-- jQuery Knob Chart -->
    <script src="<?php echo asset('assets/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
    <!-- daterangepicker -->
    <script src="<?php echo asset('assets/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' )?>"></script>
    <!-- Summernote -->
    <script src="<?php echo asset('assets/plugins/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/inputmask/jquery.inputmask.min.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/select2/js/select2.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/dropzone/dropzone.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/dropify/js/dropify.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/sweetalert2/sweetalert2.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/cookie/jquery.cookie.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/toastr/toastr.min.js') ?>"></script>
    
    {{-- <script src="<?php echo asset('assets/plugins/jquery-datatables-checkboxes/js/dataTables.checkboxes.js') ?>"></script> --}}
    <!-- overlayScrollbars -->
    <script src="<?php echo asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo asset('assets/dist/js/adminlte.js') ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo asset('assets/dist/js/demo.js') ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo asset('assets/dist/js/pages/dashboard.js') ?>"></script>
    <script src="<?php echo asset('js/main.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/bootstrap-datepicker/js/jquery.datetimepicker.full.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/bootbox/bootbox.all.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/icheck-bootstrap/js/icheck.js') ?>"></script>
    <script src="<?php echo asset('assets/plugins/icheck-bootstrap/js/custom.min.js') ?>"></script>
    <script src="<?php echo asset('assets/js/core.js') ?>"></script>
    <?php if($url == "add pos") { ?>
        <script src="<?php echo asset('assets/js/pos.js') ?>"></script>
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