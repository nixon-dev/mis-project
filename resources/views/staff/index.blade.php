@extends('staff.base')
@section('title', 'Dashboard - Management Information System')
@section('css')

    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-lg-12">
            <h2>Welcome <strong> {{ Auth::user()->name }}</strong></h2>
            <small>{{ $officeName }}'s latest documents</small>
        </div>
        <div class="col-md-4">
            <ul class="list-group clear-list m-t">
                @forelse ($documents as $d)
                    <li class="list-group-item first-item">
                        <span class="float-right">
                            {{ $d->created_at->diffForHumans() }}
                        </span>
                        <span class="label label-success">{{ $loop->iteration }}</span>
                        <a href="{{ route('staff.view-document', ['id' => $d->document_number]) }}"
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
                    {{ $officeName }}
                </p>
                <div class="row text-center">
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold m-t block">{{ $pendingCount }}</span>
                            <small class="text-muted m-b block">Pending Document</small>
                        </div>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold m-t block">{{ $approvedCount }}</span>
                        <small class="text-muted m-b block">Approved Document</small>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold m-t block">{{ $deniedCount }}</span>
                        <small class="text-muted m-b block">Denied Document</small>
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
            @if ($notifications->isEmpty())
            @else
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Notifications</h5>
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
                            <div class="ibox-content">
                                @forelse ($notifications as $notif)
                                    <div class="alert alert-{{ $notif->type == 'Approved' ? 'success' : 'danger' }}">
                                        <a class="alert-link pull-right"
                                            href="{{ route('mark.read', ['id' => $notif->notif_id]) }}">Mark as
                                            read</a>
                                        <strong>{{ $notif->type }}</strong>:
                                        <a class="text-purple"
                                            href="{{ route('staff.view-document', ['id' => $notif->document_number]) }}">{{ $notif->document_title }}</a>
                                        ({{ $notif->name }})
                                        -
                                        {{ $notif->notif_created_at = Carbon\Carbon::parse($notif->notif_created_at)->diffForHumans() }}

                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
            @endif
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
