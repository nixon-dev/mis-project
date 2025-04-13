@extends('admin.base')
@section('title', 'Dashboard - Management Information System')
@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-lg-12">
            <h2>Welcome <strong> {{ Auth::user()->name }}</strong></h2>
            <small>Latest documents</small>
        </div>
        <div class="col-md-4">
            <ul class="list-group clear-list m-t">
                @forelse ($documents as $d)
                    <li class="list-group-item first-item">
                        <span class="float-right">
                            {{ $d->created_at->diffForHumans() }}
                        </span>
                        <span class="label label-success">{{ $loop->iteration }}</span>
                        <a href="{{ route('admin.document-view', ['id' => $d->document_number]) }}"
                            class="text-dark">{{ Str::limit($d->document_title, 30, '...') }}</a>
                    </li>

                @empty
                @endforelse
            </ul>
        </div>
        <div class="col-md-5">
            <div class="flot-chart dashboard-chart" style="height: 250px; margin-top: -15px;">
                <canvas id="myChart"></canvas>
            </div>

        </div>
        <div class="col-md-3">
            <div class="statistic-box" style="margin-top: -15px;">
                <h4>
                    Documents
                </h4>
                <p>
                    All Office
                </p>
                <div class="row text-center">
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold m-t block">{{ $pendingCount }}</span>
                            <small class="text-muted m-b block">Pending</small>
                        </div>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold m-t block">{{ $approvedCount }}</span>
                        <small class="text-muted m-b block">Approved</small>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold m-t block">{{ $deniedCount }}</span>
                        <small class="text-muted m-b block">Denied</small>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold m-t block">{{ $lastMonthDocumentCount }}</span>
                            <small class="text-muted m-b block">Last Month Document</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold m-t block">{{ $thisMonthDocumentCount }}</span>
                            <small class="text-muted m-b block">This Month Document</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                </div>
                                <h5>Visitors</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $activeUserCount }}</h1>
                                <small>User</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                </div>
                                <h5>Users</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $userCount }}</h1>
                                <small>&nbsp;</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Active Users</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th>IP Adress</th>
                                    <th>User Agent</th>
                                    <th>Last Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($activeUsers as $au)
                                    <tr>
                                        <td>
                                            {{ $au->name ? $au->name : 'Guest' }}
                                        </td>
                                        <td>
                                            {{ $au->ip_address }}
                                        </td>
                                        <td>
                                            {{ $au->user_agent }}
                                        </td>
                                        <td>

                                            {{ Carbon\Carbon::parse($au->last_activity)->diffForHumans() }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No User Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Activity Logs</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>

                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content no-padding">
                            <ul class="list-group">

                                @forelse ($logs as $log)
                                    <li class="list-group-item">
                                        <p>
                                            <name class="text-dark">{{ $log->history_name }}</name> -
                                            {{ $log->history_action }}
                                            <strong>{{ $log->history_description }}</strong>
                                        </p>
                                        <small class="block text-muted"><i class="fa fa-clock-o"></i>
                                            {{ $log->created_at->diffForHumans() }}</small>
                                    </li>
                                @empty
                                @endforelse

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: @json($data->pluck('month')),
            datasets: [{
                label: 'Documents by Office (All)',
                backgroundColor: 'rgb(248, 74, 101, 0.7)',
                borderColor: 'rgba(248, 74, 101, 1)',
                data: @json($data->pluck('aggregate')),
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Documents in the last 12 months'
                    },
                },
            }

        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection
