<form class="form" action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}" method="POST">
    @csrf
    @isset($course)
        @method('PUT')
    @endisset
    <div class="form-body">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="course_name">{{ __('Course name') }}</label>
                    <input type="text" id="course_name" class="form-control {{ $errors->has('course_name') ? 'border-danger' : '' }}" placeholder="{{ __('Course name') }}" name="course_name" value="{{ isset($course) ? old('course_name', $course->course_name) : old('course_name') }}">
                    @if ($errors->has('course_name'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('course_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date">{{ __('Start Date') }}</label>
                    <input type="date" id="start_date" class="form-control {{ $errors->has('start_date') ? 'border-danger' : '' }}" placeholder="{{ __('Start Date') }}" name="start_date" value="{{ isset($course) ? old('start_date', $course->start_date) : old('start_date', date('Y-m-d')) }}">
                    @if ($errors->has('name'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <input type="hidden" id="end_date" name="end_date" value="">
        </div>
        <div class="row justify-content-start">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="schedule_id">{{ __('Schedule') }}</label>
                    <select id="schedule_id" name="schedule_id" class="form-control {{ $errors->has('schedule_id') ? 'border-danger' : '' }}">
                        <option value="">{{ __('Please chosse schedule for course') }}</option>
                        @foreach($schedules as $schedule_id => $schedule_name)
                            <option value="{{ $schedule_id }}" {{ isset($course) && $course->schedule_id == $schedule_id ? 'selected' : '' }}>{{ $schedule_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('schedule_id'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('schedule_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions center">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <button type="submit" class="btn btn-outline-purple btn-min-width btn-glow mr-1 mb-1">
                    <i class="la la-check-square-o"></i> {{ isset($course) ? __('Update') : __('Save') }}
                </button>
                <a class="btn btn-outline-danger btn-min-width btn-glow mr-1 mb-1" href="{{ route('courses.index') }}">
                    <i class="ft-x"></i> {{ __('Cancel') }}
                </a>
            </div>
        </div>
    </div>
</form>
