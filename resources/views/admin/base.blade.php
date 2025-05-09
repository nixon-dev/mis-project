<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">
    <title> @yield('title', 'Management Information System')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personal.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
    @yield('css')

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
</head>

<body class="fixed-sidebar">

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side dark-skin" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header ">
                        <div class="dropdown profile-element">
                            <img alt="image" class="rounded-circle" src="{{ asset('img/logo/diffun_quirino.png') }}"
                                style="width: 50px; height: 50x; object-fit: cover;" />
                            <span class="block m-t-xs font-bold">{{ Auth::user()->name ?? 'Guest Name' }}</span>
                            <span class="text-muted text-xs block">{{ Auth::user()->role ?? 'Guest' }}</span>
                        </div>
                        <div class="dark-skin logo-element">
                            MIS
                        </div>
                    </li>

                    <li class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.index') }}" class="text-white"><i class="fa fa-pie-chart"></i>
                            <span class="nav-label">Dashboard</span> </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.document') ? 'active' : '' }}">
                        <a href="{{ route('admin.document') }}" class="text-white"><i class="fa fa-file-text "></i>
                            <span class="nav-label">Document
                                Tracking</span></a>
                    </li>

                    <li class="{{ request()->routeIs('admin.new-settings') ? 'active' : '' }}">
                        <a href="{{ route('admin.new-settings') }}" class="text-white"><i class="fa fa-user"></i>
                            <span class="nav-label">Account Settings</span></a>
                    </li>

                    <li class="{{ request()->routeIs('admin.users-list') ? 'active' : '' }}">
                        <a href="{{ route('admin.users-list') }}" class="text-white"><i class="fa fa-users"></i>
                            <span class="nav-label">Users</span></a>
                    </li>
                    <li
                        class="{{ request()->routeIs(['admin.co', 'admin.units', 'admin.office', 'admin.history', 'admin.responsibility-center', 'admin.mooe']) ? 'active' : '' }}">
                        <a href="#" aria-expanded="false" class="text-white"><i class="fa fa-gear"
                                aria-hidden="true"></i>
                            <span class="nav-label">Settings</span><span class="fa arrow" aria-hidden="true"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">

                            <li class={{ request()->routeIs('admin.co') ? 'active' : '' }}><a
                                    href="{{ route('admin.co') }}">Capital Outlay</a></li>
                            <li class={{ request()->routeIs('admin.mooe') ? 'active' : '' }}><a
                                    href="{{ route('admin.mooe') }}">MOOE</a></li>
                            <li class={{ request()->routeIs('admin.office') ? 'active' : '' }}><a
                                    href="{{ route('admin.office') }}">Office List</a></li>
                            <li class={{ request()->routeIs('admin.units') ? 'active' : '' }}><a
                                    href="{{ route('admin.units') }}">Unit List</a></li>

                            <li class={{ request()->routeIs('admin.history') ? 'active' : '' }}><a
                                    href="{{ route('admin.history') }}">Activity Log</a></li>
                        </ul>
                    </li>

                </ul>


            </div>
        </nav>



        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                <nav class="navbar navbar-static-top dark-skin" role="navigation">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-success" href="#"><i
                                class="fa fa-bars"></i></a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right ">


                        {{-- <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="img/a7.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="float-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following <strong>Monica
                                                Smith</strong>. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="img/a4.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica
                                                Smith</strong>. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a class="dropdown-item float-left" href="profile.html">
                                            <img alt="image" class="rounded-circle" src="img/profile.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">23h ago</small>
                                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html" class="dropdown-item">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="profile.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                            <span class="float-right text-muted small">12 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a href="grid_options.html" class="dropdown-item">
                                        <div>
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                            <span class="float-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html" class="dropdown-item">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li> --}}


                        <li>
                            <a href="{{ route('logout') }}" class="text-white">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>


            @yield('content')




            <div class="footer">

                <div class="text-dark pull-right">
                    <strong">Copyright</strong> LGU DIFFUN &copy; 2025
                </div>
            </div>

        </div>
    </div>



    @yield('script')

</body>

</html>
