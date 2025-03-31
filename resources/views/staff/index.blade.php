@extends('staff.base')
@section('title', 'Dashboard - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Dashboard</strong>
                </li>
            </ol>
        </div>
        {{-- <div class="col-sm-4">
            <div class="title-action">
                <a href="" class="btn btn-primary">This is action area</a>
            </div>
        </div> --}}
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    {{-- <span class="label label-success float-right">Count</span> --}}
                                </div>
                                <h5>Documents</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $lastMonthDocumentCount }}</h1>
                                {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                                <small>Last Month</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <div class="ibox-tools">
                                    {{-- <span class="label label-success float-right">Count</span> --}}
                                </div>
                                <h5>Documents</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{{ $thisMonthDocumentCount }}</h1>
                                {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                                <small>This Month</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox">
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
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: @json($data->pluck('month')),
            datasets: [{
                label: {{ Js::from($office->office_name) }},
                backgroundColor: 'rgb(248, 74, 101, 0.7)',
                borderColor: 'rgba(248, 74, 101, 1)',
                data: @json($data->pluck('aggregate')),
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                maintainAspectRatio: false, // Important: allows setting custom dimensions
                responsive: true, // Important: disables responsiveness
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
