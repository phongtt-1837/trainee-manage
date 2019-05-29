<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @can ('access-admin')
            <li class=" nav-item"><a href="{{ route('dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('Dashboard') }}</span></a>
            </li>
            @endcan
            @can ('see-trainees')
            <li class=" nav-item"><a href="{{ route('home') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('Dashboard') }}</span></a>
            </li>
            @endcan
            @can ('see-admin')
            <li class=" nav-item">
                <a href="#"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('Trainers') }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('trainers.index') }}" data-i18n="nav.templates.vert.main">{{ __('All Trainers') }}</a>
                    </li>
                    <li><a class="menu-item" href="{{ route('trainers.create') }}" data-i18n="nav.templates.horz.main">{{ __('Create Trainer') }}</a>
                    </li>
                </ul>
            </li>
            @endcan
            @if (Auth::user()->can('see-admin') || Auth::user()->can('see-trainers'))
            <li class=" nav-item">
                <a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('Trainees') }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('trainees.index') }}" data-i18n="nav.templates.vert.main">{{ __('All Trainees') }}</a>
                    </li>
                    <li><a class="menu-item" href="{{ route('trainees.create') }}" data-i18n="nav.templates.horz.main">{{ __('Create Trainee') }}</a>
                    </li>
                </ul>
            </li>
            @endif
            @if (Auth::user()->can('see-admin') || Auth::user()->can('see-trainers'))
            <li class=" nav-item">
                <a href="#"><i class="la la-optin-monster"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('Schedule') }}</span></a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="#" data-i18n="nav.templates.vert.main">{{ __('Phase') }}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('phases.index') }}" data-i18n="nav.templates.vert.classic_menu">{{ __('All Phase') }}</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('phases.create') }}" data-i18n="nav.templates.vert.compact_menu">{{ __('Create New Phase') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#" data-i18n="nav.templates.horz.main">{{ __('Schedule') }}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('schedules.index') }}" data-i18n="nav.templates.horz.classic">{{ __('All Schedule') }}</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('schedules.create') }}" data-i18n="nav.templates.horz.top_icon">{{ __('Create New Schedule') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="menu-item" href="#" data-i18n="nav.templates.horz.main">{{ __('Course') }}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('courses.index') }}" data-i18n="nav.templates.horz.classic">{{ __('All Courses') }}</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('courses.create') }}" data-i18n="nav.templates.horz.top_icon">{{ __('Create New Course') }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
            <li class=" nav-item">
                <a href="#"><i class="la la-file-text-o"></i><span class="menu-title" data-i18n="nav.templates.main">{{ __('Test') }}</span></a>
                <ul class="menu-content">
                    <!-- For Trainer here -->
                    @if (Auth::user()->can('see-admin') || Auth::user()->can('see-trainers'))
                    <li>
                        <a class="menu-item" href="{{ route('tests.index') }}" data-i18n="nav.templates.vert.main">{{ __('All Tests') }}</a>
                    </li>
                    @endif
                    <!-- End Trainer here -->
                    @can ('see-trainees')
                    <!-- For Trainee here -->
                    <li>
                        <a class="menu-item" href="{{ route('trainees.show_test') }}" data-i18n="nav.templates.vert.main">{{ __('My Tests in courses') }}</a>
                    </li>
                    @endcan
                </ul>
            @can ('see-trainees')
            <li class=" nav-item"><a href="{{ route('trainee.trainee_schedule') }}"><i class="la la-calendar"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('My Schedule') }}</span></a>
            </li>
            @endcan
            @can ('see-trainees')
                <li class=" nav-item"><a href="{{ route('trainee.trainee_result') }}"><i class="la la-calendar"></i><span class="menu-title" data-i18n="nav.dash.main">{{ __('My Result') }}</span></a>
                </li>
            @endcan
        </ul>
    </div>
</div>
