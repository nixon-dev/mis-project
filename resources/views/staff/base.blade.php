<!DOCTYPE html>
<html data-bs-theme="dark">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', 'Management Information System')</title>

    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personal.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>


    @yield('css')

    <style>
        .swal2-container {
            z-index: 99999 !important;
        }
    </style>

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
                <ul class="nav metismenu " id="side-menu">
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

                    <li class="{{ request()->routeIs('staff.index') ? 'active' : '' }}">
                        <a href="{{ url('/staff/dashboard') }}" class="text-white"><i class="fa fa-pie-chart"></i>
                            <span class="nav-label">Dashboard</span> </a>
                    </li>

                    <li
                        class="{{ request()->routeIs(['document.draft', 'document.pending', 'document.denied', 'document.approved', 'document.view']) ? 'active' : '' }}">
                        <a href="#" aria-expanded="false" class="text-white"><i class="fa fa-gear"
                                aria-hidden="true"></i>
                            <span class="nav-label">Document Tracking</span><span class="fa arrow"
                                aria-hidden="true"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">

                            <li class="{{ request()->routeIs('document.draft') ? 'active' : '' }}"><a
                                    href="{{ route('document.draft') }}">Draft</a></li>
                            <li class="{{ request()->routeIs('document.pending') ? 'active' : '' }}"><a
                                    href="{{ route('document.pending') }}">Pending</a></li>
                            <li class="{{ request()->routeIs('document.approved') ? 'active' : '' }}"><a
                                    href="{{ route('document.approved') }}">Approved</a></li>
                            <li class="{{ request()->routeIs('document.denied') ? 'active' : '' }}"><a
                                    href="{{ route('document.denied') }}">Denied</a></li>
                        </ul>
                    </li>



                    {{-- THIS APPEARS IF STAFF IS ASSIGNED TO BUDGET OFFICE --}}
                    <div class="d-none">
                        {{ $budgetOffice = \App\Models\Settings::where('id', '1')->first()->budget_office }}
                    </div>

                    @if (Auth::user()->office_id == $budgetOffice)
                        <li class="">
                            <a href="{{ route('budget.management') }}" class="text-white"><i class="fa fa-credit-card "></i>
                                <span class="nav-label">Budget Management</span></a>
                        </li>
                        <li
                            class="{{ request()->routeIs(['budget.pending', 'budget.approved', 'budget.denied', 'budget.view']) ? 'active' : '' }}">
                            <a href="#" aria-expanded="false" class="text-white">
                                <i class="fa fa-file-text" aria-hidden="true"></i>
                                <span class="nav-label">External Documents</span>
                                <span class="fa arrow" aria-hidden="true"></span>
                            </a>
                            <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                <li class="{{ request()->routeIs('budget.pending') ? 'active' : '' }}">
                                    <a href="{{ route('budget.pending') }}">Pending Documents</a>
                                </li>
                                <li class="{{ request()->routeIs('budget.approved') ? 'active' : '' }}">
                                    <a href="{{ route('budget.approved') }}">Approved Documents</a>
                                </li>
                                <li class="{{ request()->routeIs('budget.denied') ? 'active' : '' }}">
                                    <a href="{{ route('budget.denied') }}">Denied Documents</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li
                            class="{{ request()->routeIs(['external.pending', 'external.approved', 'external.denied', 'external.view']) ? 'active' : '' }}">
                            <a href="#" aria-expanded="false" class="text-white">
                                <i class="fa fa-file-text" aria-hidden="true"></i>
                                <span class="nav-label">External Documents</span>
                                <span class="fa arrow" aria-hidden="true"></span>
                            </a>
                            <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                <li class="{{ request()->routeIs('external.pending') ? 'active' : '' }}">
                                    <a href="{{ route('external.pending') }}">Pending Documents</a>
                                </li>
                                <li class="{{ request()->routeIs('external.approved') ? 'active' : '' }}">
                                    <a href="{{ route('external.approved') }}">Approved Documents</a>
                                </li>
                                <li class="{{ request()->routeIs('external.denied') ? 'active' : '' }}">
                                    <a href="{{ route('external.denied') }}">Denied Documents</a>
                                </li>
                            </ul>
                        </li>
                    @endif





                    <li class="{{ request()->routeIs('staff.settings') ? 'active' : '' }}">
                        <a href="{{ route('staff.settings') }}" class="text-white"><i class="fa fa-gear "></i>
                            <span class="nav-label">Settings</span></a>
                    </li>

                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row">
                <nav class="navbar navbar-static-top dark-skin" role="navigation">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i
                                class="fa fa-bars"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right ">


                        @php
                            @$assignedOffice = Auth::user()->office_id;
                            use App\Models\Notifications;
                            $data = Notifications::leftJoin(
                                'document',
                                'document.document_id',
                                '=',
                                'notifications.document_id',
                            )
                                ->where('document_origin', $assignedOffice)
                                ->where('read_at', null)
                                ->select('document.*', 'notifications.*', 'notifications.created_at as c_at')
                                ->orderBy('c_at', 'DESC')
                                ->take(5)
                                ->get();

                            $notifCount = Notifications::leftJoin(
                                'document',
                                'document.document_id',
                                '=',
                                'notifications.document_id',
                            )
                                ->where('document_origin', $assignedOffice)
                                ->where('read_at', null)
                                ->count();
                        @endphp

                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                @if ($notifCount != 0)
                                    <i class="fa fa-bell"></i> <span
                                        class="label label-primary">{{ $notifCount }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">

                                @forelse($data as $d)
                                    <li>
                                        <a href="{{ route('viewnotif', ['id' => $d->id, 'number' => $d->document_number]) }}"
                                            class="dropdown-item">
                                            <div>
                                                <strong>{{ $d->type }}</strong>:
                                                {{ Str::limit($d->document_title, 15, '...') }}
                                                <span
                                                    class="float-right text-muted small">{{ Carbon\Carbon::parse($d->c_at)->diffForHumans() }}</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="dropdown-divider"></li>
                                @empty
                                    asdasd
                                @endforelse

                            @empty($data)
                            @else
                                <li>
                                    <div class="text-center link-block">
                                        <a href="{{ route('staff.notifiations') }}" class="dropdown-item">
                                            <strong>See All Notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            @endempty
                        </ul>
                    </li>


                    <li>
                        <a href="{{ url('/logout') }}" class="text-white">
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
