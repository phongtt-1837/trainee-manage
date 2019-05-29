@extends('admin.layouts.master')
@section('title', __('My schedule'))
@section('content')
    <div class="content-wrapper">
        <h2>{{ __($schedule->name) }}</h2>
        <div id="expired">
            @if (is_null($current_phase['days_left']) || $current_phase['days_left'] == '')
                <h2>{{ __('Expired') }}</h2>
            @else
                <h2>{{ __('This phase has ' . $current_phase['days_left'] . ' day(s) left') }}</h2>
            @endif
        </div>
        <input type="hidden" id="current_phase" name="current_phase" value="{{ $current_phase['current_phase'] }}">
        <input type="hidden" id="days_left" name="days_left" value="{{ $current_phase['days_left'] }}">
        <div id="my-timeline" data-duration="{{ json_encode($duration) }}">

        </div>
    </div>
@endsection
@push ('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/trainee-manage/dist/jquery.roadmap.min.css') }}">
@endpush
@push ('js')
    <script src="{{ asset('bower_components/trainee-manage/dist/jquery.roadmap.js') }}"></script>
    <script src="{{ asset('js/timeline.js') }}"></script>
@endpush
