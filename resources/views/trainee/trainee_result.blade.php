@extends('admin.layouts.master')
@section('title', __('My Result'))
@section('content')
    <div class="content-wrapper">
        <h2>{{ __(auth()->user()->trainee->name) }}</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Phase') }}</th>
                        <th>{{ __('Mark') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($have_tests as $key => $value)
                    <tr class="phase">
                        <th>
                            <label>{{ $key }}</label>
                        </th>
                        <th>
                            <h4>{{ $value }}</h4>
                        </th>
                    </tr>
                @endforeach
                @foreach ($not_tests as $key => $value)
                    <tr class="phase">
                        <th>
                            <label>{{ $key }}</label>
                        </th>
                        <th>
                            <h4>{{ $value }}</h4>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
