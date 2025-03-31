@extends('admin.base')
@section('title', 'Dashboard - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Dashboard</strong>
                </li>
            </ol>
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
                                <h5>Document</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $lastMonthDocumentCount }}</h1>
                                <small>Last Month</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                </div>
                                <h5>Document</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $thisMonthDocumentCount }}</h1>
                                <small>This Month</small>
                            </div>
                        </div>
                    </div>

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
                        <h5>Document Graph</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="height: 300px;">
                        <canvas id="myChart"></canvas>

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
                                            <name class="text-purple">{{ $log->history_name }}</name> - 
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
