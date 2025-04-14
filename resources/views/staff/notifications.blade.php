@extends('staff.base')
@section('title', 'Setting - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Notifications</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Notifications</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                @include('components.message')
            </div>

            <div class="col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Notifications</h5>
                    </div>
                    <div class="ibox-content">
                        @forelse ($notifications as $notif)
                            <div class="alert alert-{{ $notif->type == 'Approved' ? 'success' : 'danger' }}">
                                <a class="alert-link pull-right"
                                    href="{{ route('mark.read', ['id' => $notif->notif_id]) }}">Mark as
                                    read</a>
                                <strong>{{ $notif->type }}</strong>:
                                <a class="text-purple"
                                    href="{{ route('viewnotif', ['id' => $notif->notif_id, 'number' => $notif->document_number]) }}">{{ $notif->document_title }}</a>
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
    </div>
@endsection
