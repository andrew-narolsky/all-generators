<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('admin/img/icon.ico') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{ asset('admin/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['admin/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/atlantis.min.css') }}">
</head>
<body>
<div class="wrapper">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">

            <a href="index.html" class="logo">
                <img src="{{ asset('admin/img/logo.svg') }}" alt="navbar brand" class="navbar-brand">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

            <div class="container-fluid">
                <div class="collapse" id="search-nav">
                    <form class="navbar-left navbar-form nav-search mr-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pr-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="Search ..." class="form-control">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item toggle-nav-search hidden-caret">
                        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="{{ asset('admin/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="{{ asset('admin/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4>Hizrian</h4>
                                            <p class="text-muted">hello@example.com</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                       onclick="document.getElementById('logout-form').submit(); return false;">{{ __('Log out') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                        <img src="{{ asset('admin/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Hizrian
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="#profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-primary">
                    <li class="nav-item active">
                        <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="dashboard">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="../demo1/index.html">
                                        <span class="sub-item">Dashboard 1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../demo2/index.html">
                                        <span class="sub-item">Dashboard 2</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                        <h4 class="text-section">Components</h4>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Base</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="components/avatars.html">
                                        <span class="sub-item">Avatars</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/buttons.html">
                                        <span class="sub-item">Buttons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/gridsystem.html">
                                        <span class="sub-item">Grid System</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/panels.html">
                                        <span class="sub-item">Panels</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/notifications.html">
                                        <span class="sub-item">Notifications</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/sweetalert.html">
                                        <span class="sub-item">Sweet Alert</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/font-awesome-icons.html">
                                        <span class="sub-item">Font Awesome Icons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/simple-line-icons.html">
                                        <span class="sub-item">Simple Line Icons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/flaticons.html">
                                        <span class="sub-item">Flaticons</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="components/typography.html">
                                        <span class="sub-item">Typography</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#sidebarLayouts">
                            <i class="fas fa-th-list"></i>
                            <p>Sidebar Layouts</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="sidebarLayouts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="sidebar-style-1.html">
                                        <span class="sub-item">Sidebar Style 1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="overlay-sidebar.html">
                                        <span class="sub-item">Overlay Sidebar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="compact-sidebar.html">
                                        <span class="sub-item">Compact Sidebar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="static-sidebar.html">
                                        <span class="sub-item">Static Sidebar</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="icon-menu.html">
                                        <span class="sub-item">Icon Menu</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-pen-square"></i>
                            <p>Forms</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="forms/forms.html">
                                        <span class="sub-item">Basic Form</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#tables">
                            <i class="fas fa-table"></i>
                            <p>Tables</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="tables/tables.html">
                                        <span class="sub-item">Basic Table</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tables/datatables.html">
                                        <span class="sub-item">Datatables</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#maps">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Maps</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="maps">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="maps/jqvmap.html">
                                        <span class="sub-item">JQVMap</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#charts">
                            <i class="far fa-chart-bar"></i>
                            <p>Charts</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="charts/charts.html">
                                        <span class="sub-item">Chart Js</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="charts/sparkline.html">
                                        <span class="sub-item">Sparkline</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="widgets.html">
                            <i class="fas fa-desktop"></i>
                            <p>Widgets</p>
                            <span class="badge badge-success">4</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#submenu">
                            <i class="fas fa-bars"></i>
                            <p>Menu Levels</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="submenu">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a data-toggle="collapse" href="#subnav1">
                                        <span class="sub-item">Level 1</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav1">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a data-toggle="collapse" href="#subnav2">
                                        <span class="sub-item">Level 1</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div class="collapse" id="subnav2">
                                        <ul class="nav nav-collapse subnav">
                                            <li>
                                                <a href="#">
                                                    <span class="sub-item">Level 2</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="sub-item">Level 1</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="mx-4 mt-2">
                        <a href="http://themekita.com/atlantis-bootstrap-dashboard.html" class="btn btn-primary btn-block"><span class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Buy Pro</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Sidebar -->
    @yield('content')
    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                        <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeTopBarColor" data-color="dark"></button>
                        <button type="button" class="changeTopBarColor" data-color="blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="green"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange"></button>
                        <button type="button" class="changeTopBarColor" data-color="red"></button>
                        <button type="button" class="changeTopBarColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                        <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="green2"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                        <button type="button" class="changeTopBarColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button type="button" class="selected changeSideBarColor" data-color="white"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Background</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                        <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                        <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                        <button type="button" class="changeBackgroundColor" data-color="dark"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            <i class="flaticon-settings"></i>
        </div>
    </div>
    <!-- End Custom template -->
</div>
<!--   Core JS Files   -->
<script src="{{ asset('admin/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ asset('admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('admin/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Atlantis JS -->
<script src="{{ asset('admin/js/atlantis.min.js') }}"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{ asset('admin/js/setting-demo.js') }}"></script>

</body>
</html>