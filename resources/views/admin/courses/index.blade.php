@extends('admin.layouts.master')
@section('title', __('Course'))
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="heading-left">
                            <h4 class="card-title">{{ __('All courses') }}</h4>
                        </div>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a href="{{ route('courses.create') }}" class="btn btn-outline-info btn-glow">{{ __('Create') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4 ml-auto">
                            <select id="select_language" class="form-control border-info" data-url="{!! http_build_query(Request::except('language')) !!}">
                                <option value="0">{{ __('All') }}</option>
                                @foreach($languages as $language)
                                <option value="{{ $language->id }}" {{ request()->query('language') == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @include('admin.components.alert')
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Course') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('End Date') }}</th>
                                        <th>{{ __('Language') }}</th>
                                        <th>{{ __('Course For') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <th scope="row">{{ $course->id }}</th>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ $course->start_date }}</td>
                                            <td>{{ $course->end_date }}</td>
                                            <td>{{ optional($course->schedule->language)->name }}</td>
                                            <td>{{ optional($course->schedule->stafftype)->name }}</td>
                                            <td>
                                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-outline-light round mr-1">{{ __('Edit') }}</a>
                                                <button type="button" class="btn btn-outline-danger round mr-1" data-toggle="modal" data-target="#delete-{{ $course->id }}">{{ __('Delete') }}</button>
                                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-info round mr-1">{{ __('Show') }}</a>
                                                @include('admin.components.modal', ['route' => route('courses.destroy', $course->id), 'id' => $course->id])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ mix('js/filter.js') }}"></script>
@endpush
