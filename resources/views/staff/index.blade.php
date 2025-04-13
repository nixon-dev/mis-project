@extends('staff.base')
@section('title', 'Dashboard - Management Information System')
@section('css')

    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @include('components.message')
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-lg-12">
            <h2>Welcome <strong> {{ Auth::user()->name }}</strong></h2>
            <small>{{ $officeName }}'s latest documents</small>
        </div>
        <div class="col-md-4 mb-3">
            <ul class="list-group clear-list m-t">
                @forelse ($documents as $d)
                    <li class="list-group-item first-item">
                        <span class="float-right">
                            {{ $d->created_at->diffForHumans() }}
                        </span>
                        <span class="label label-success">{{ $loop->iteration }}</span>
                        <a href="{{ route('document.view', ['id' => $d->document_number]) }}"
                            class="text-dark">{{ Str::limit($d->document_title, 30, '...') }}</a>
                    </li>

                @empty
                @endforelse
            </ul>
        </div>
        <div class="col-md-5 mb-3">
            <div class="flot-chart dashboard-chart" style="height: 250px; margin-top: -15px;">
                <canvas id="document-chart"></canvas>
            </div>

        </div>
        <div class="col-md-3 mb-3">
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
            <div class="col-lg-9 row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Total Budget</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <h3 class="no-margins">₱ {{ number_format($totalBudget, 2) }}</h3>
                                    <div class="font-bold text-purple">Overall</div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="no-margins">₱ {{ number_format($thisMonthBudget, 2) }}</h3>
                                    <div class="font-bold text-purple">This Month</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->office_id == $budgetOfficeId)
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Pending Documents</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="no-margins font-bold"><i class="fa fa-file-text-o"></i>
                                            {{ $pendingDocxCount }}</h2>
                                        <div class="font-bold text-purple">&nbsp;</div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
                                                href="{{ route('viewnotif', ['id' => $notif->id, 'number' => $notif->document_number]) }}">{{ $notif->document_title }}</a>
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
            <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-content">
                        Test
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
                document.getElementById('document-chart'),
                config
            );
        </script>
    @endsection
