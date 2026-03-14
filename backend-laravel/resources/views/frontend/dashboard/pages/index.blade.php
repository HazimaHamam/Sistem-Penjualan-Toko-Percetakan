@extends('frontend.dashboard.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @include('frontend.dashboard.partials.styles')
@endpush

@section('content')
<div class="dash-bg relative z-10 space-y-5">

    @include('frontend.dashboard.partials.header')

    @include('frontend.dashboard.partials.stats')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        @include('frontend.dashboard.partials.chart')
        @include('frontend.dashboard.partials.activity')
    </div>

    @include('frontend.dashboard.partials.recent-orders')

</div>
@endsection

@push('scripts')
    @include('frontend.dashboard.partials.scripts')
@endpush