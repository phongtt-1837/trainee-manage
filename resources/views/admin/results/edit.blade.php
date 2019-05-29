@extends('admin.layouts.master')
@section('title', __('Result'))
@section('content')
    <div class="content-wrapper">
        <h2>{{ $trainee->user->name }}</h2>
        <form class="form" action="{{ route('results.update', $trainee->id) }}" method="post">
            @method('PATCH')
            @csrf
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
                                <input type="text" name="{{ $key }}" value="{{ $value }}">
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="form-actions center">
                    <button type="submit" class="btn btn-outline-purple btn-min-width btn-glow mr-1 mb-1">
                        <i class="la la-check-square-o"></i> {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
