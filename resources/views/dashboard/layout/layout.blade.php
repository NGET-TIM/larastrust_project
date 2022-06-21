<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="http://localhost/laravel_8/admin/dashboard" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="http://localhost/laravel_8/admin/dashboard" class="nav-link">dashboard</a>
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
                <a class="dropdown-item btn_select_theme_color" id="style_standard">
                    <span class="float-right color_box standard_color text-sm"></span>
                    {{ __('lang.default') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn_select_theme_color" id="style_purple">
                    <span class="float-right color_box purple_color text-sm"></span>
                    {{ __('lang.purple') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn_select_theme_color" id="style_blue">
                    <span class="float-right color_box blue_color text-sm"></span>
                    {{ __('lang.blue') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn_select_theme_color" id="style_pink">
                    <span class="float-right color_box pink_color text-sm"></span>
                    {{ __('lang.pink') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn_select_theme_color" id="style_flat_red">
                    <span class="float-right color_box flat_red_color text-sm"></span>
                    {{ __('lang.flat_red') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn_select_theme_color" id="style_green">
                    <span class="float-right color_box green_color text-sm"></span>
                    {{ __('lang.green') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn_select_theme_color" id="style_dark">
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

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link <?= $url == 'dashboard' ? 'active' : '' ?>">
        <div class="user_image_left_site dashboard_left_img">
        <?php if(Auth::user()->avatar != '') { ?>
            <img src="{{ url('/') }}/{{ Auth::user()->avatar }}" class="img-responsive img-responsive img-fluid img-circle" alt="">
        <?php } else { ?>
            <img src="{{ asset('resources/assets/images/main-logo.png') }}" alt="Dashboard Logo" class="img-responsive img-fluid img-circle"
            style="opacity: .8">
        <?php } ?>
        </div>
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if(Auth::user()->hasRole(['supper-admin', 'admin']))
                <li class="nav-header">{{ __('lang.settings_control') }}</li>
                <li class="nav-item <?= $url == __('lang.system_settings') || $url == 'profile' || $url == 'customers' || $url == 'add customer' || $url == 'edit customer' || $url == 'tables' || $url == 'list table' || $url == 'users' || $url == 'add user' || $url == 'edit user' || $url == 'list roles' || $url == 'add role' || $url == 'edit role permissions' || $url == 'add role permissions' || $url == 'list permissions' || $url == 'edit permission' ? 'menu-open active_border' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{ __('lang.settings') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item <?= $url == __('lang.system_settings') || $url == 'add settings' || $url == 'edit settings' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>{{__('lang.system_setting')}}</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.index') }}" class="nav-link <?= $url == __('lang.system_settings') || $url == 'edit system settings' ? 'active' : '' ?>">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>{{__('lang.system_setting')}}</p>
                                    </a>
                                </li>
                                @if(Auth::user()->hasRole(['supperadmin', 'admin']))
                                <li class="nav-item">
                                    <a href="{{ route('setting.update') }}" class="nav-link <?= $url == 'update setting' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>{{ __('lang.update_setting') }}</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item <?= $url == 'list roles' || $url == 'add role' || $url == 'edit role permissions' || $url == 'add role permissions' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-key"></i>
                                <p>Roles</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link <?= $url == 'list roles' || $url == 'edit role permissions' ? 'active' : '' ?>">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>Role List</p>
                                    </a>
                                </li>
                                @if(Auth::user()->hasRole(['supperadmin', 'admin']))
                                <li class="nav-item">
                                    <a href="{{ route('role.permissions.add') }}" class="nav-link <?= $url == 'add role permissions' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Role</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item <?= $url == 'list permissions' || $url == 'add permission' || $url == 'edit permissions' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>Permissions</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('permissions.index') }}" class="nav-link <?= $url == 'list permissions' || $url == 'edit permission' ? 'active' : '' ?>">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>Permissions List</p>
                                    </a>
                                </li>
                                @if(Auth::user()->hasRole(['supperadmin', 'admin']))
                                <li class="nav-item">
                                    <a href="{{ route('create') }}" class="nav-link <?= $url == 'add permission' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-plus"></i>
                                        <p>Add Permission</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item <?= $url == 'profile' || $url == 'add user' || $url == 'edit user' || $url == 'users' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Users</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link <?= $url == 'users' ? 'active' : '' ?>">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>Users List</p>
                                    </a>
                                </li>
                                @if(Auth::user()->hasRole(['supper-admin', 'admin']))
                                <li class="nav-item">
                                    <a href="{{ route('create') }}" class="nav-link <?= $url == 'add user' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-user-plus"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                                @endif
                                @if($url == 'edit user')
                                <li class="nav-item">
                                    <a href="{{ url()->current() }}" class="nav-link active">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Edit User</p>
                                    </a>
                                </li>
                                @endif
                                @if($url == 'profile')
                                <li class="nav-item">
                                    <a href="{{ url()->current() }}" class="nav-link active">
                                        <i class="nav-icon fas fa-user-plus"></i>
                                        <p>User Profile</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item <?= $url == 'tables' || $url == 'add table' || $url == 'edit table' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Tables</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.table.index') }}" class="nav-link <?= $url == 'tables' ? 'active' : '' ?>">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>Tables List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- customer --}}
                    <ul class="nav nav-treeview">
                        <li class="nav-item <?= $url == 'customers' || $url == 'add customer' || $url == 'edit customer' ? 'menu-open' : '' ?>">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>{{ __('lang.customers') }}</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customer.index') }}" class="nav-link <?= $url == 'customers' ? 'active' : '' ?>">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>{{ __('lang.customers_list') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-header">Back-End Control</li>
                <li class="nav-item <?= $url == 'products' || $url == 'add product' || $url == 'edit product' ? 'menu-open active_border' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>
                            {{ __('lang.products') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link <?= $url == 'products' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Product List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.add') }}" class="nav-link <?= $url == 'add product' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        @if ($url == 'edit product')
                        <li class="nav-item">
                            <a href="{{ url()->current() }}" class="nav-link <?= $url == 'edit product' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Edit Product</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                {{-- purchase --}}
                <li class="nav-item <?= $url == 'purchase' || $url == 'add purchase' || $url == 'edit purchase' ? 'menu-open active_border' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>
                            Purchase
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}" class="nav-link <?= $url == 'purchases' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Purchases List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchase.create') }}" class="nav-link <?= $url == 'add purchase' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Add Purchases</p>
                            </a>
                        </li>
                        @if ($url == 'edit purchases')
                        <li class="nav-item">
                            <a href="{{ url()->current() }}" class="nav-link <?= $url == 'edit purchase' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Edit Purchase</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                {{-- category --}}
                <li class="nav-item <?= $url == 'categories' || $url == 'add category' || $url == 'edit category' ? 'menu-open active_border' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-barcode"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link <?= $url == 'categories' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.create') }}" class="nav-link <?= $url == 'add category' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
