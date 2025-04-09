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


    @yield('css')


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

                    {{-- <li class="{{ request()->routeIs('staff.document') ? 'active' : '' }}">
                        <a href="{{ url('/staff/document-tracking') }}" class="text-white"><i
                                class="fa fa-file-text "></i> <span class="nav-label">Document
                                Tracking</span></a>
                    </li> --}}

                    <li
                        class="{{ request()->routeIs(['staff.document-draft', 'staff.document-pending', 'staff.document-denied', 'staff.document-approved']) ? 'active' : '' }}">
                        <a href="#" aria-expanded="false" class="text-white"><i class="fa fa-gear"
                                aria-hidden="true"></i>
                            <span class="nav-label">Document Tracking</span><span class="fa arrow"
                                aria-hidden="true"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">

                            <li class="{{ request()->routeIs('staff.document-draft') ? 'active' : '' }}"><a
                                    href="{{ route('staff.document-draft') }}">Draft</a></li>
                            <li class="{{ request()->routeIs('staff.document-pending') ? 'active' : '' }}"><a
                                    href="{{ route('staff.document-pending') }}">Pending</a></li>
                            <li class="{{ request()->routeIs('staff.document-approved') ? 'active' : '' }}"><a
                                    href="{{ route('staff.document-approved') }}">Approved</a></li>
                            <li class="{{ request()->routeIs('staff.document-denied') ? 'active' : '' }}"><a
                                    href="{{ route('staff.document-denied') }}">Denied</a></li>
                        </ul>
                    </li>

                    {{-- THIS APPEARS IF STAFF IS ASSIGNED TO BUDGET OFFICE --}}
                    <div class="d-none">
                        {{ $budgetOffice = \App\Models\Settings::where('id', '1')->first()->budget_office }}
                    </div>

                    @if (Auth::user()->office_id == $budgetOffice)
                        <li class="{{ request()->routeIs('budget.pending') ? 'active' : '' }}">
                            <a href="{{ route('budget.pending') }}" class="text-white"><i class="fa fa-file-text"></i>
                                Pending Documents</a>
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

<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js') }}"></script>
<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

@yield('script')

</body>

</html>
