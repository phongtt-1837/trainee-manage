<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="index.html">
                        <img class="brand-logo" alt="modern admin logo" src="{{ asset('bower_components/tracking_theme/app-assets/images/logo/logo.png') }}" }>
                        <h3 class="brand-text">{{ __('Trainee Manage') }}</h3>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    <li class="nav-item nav-search">
                        <a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text" placeholder="{{ __('Search') }}">
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">{{ __('Hello, ') }}
                            <span class="user-name text-bold-700">{{ auth()->user()->name }}</span>
                            </span>
                            <span class="avatar avatar-online">
                            <img src="{{asset('bower_components/tracking_theme/app-assets/images/portrait/small/avatar-s-19.png') }}" alt="avatar"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('trainers.profile', auth()->user()->id) }}"><i class="ft-user"></i> {{ __('Change Password') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ft-power"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span class="selected-language"></span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-gb"></i> {{ __('English') }}</a>
                            <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-vn"></i> {{ __('Vietnamese') }}</a>
                        </div>
                    </li>
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" id="current_user_id">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                            <span class="noti badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ isset(auth()->user()->trainee) ? auth()->user()->trainee->unreadNotifications->count() : (isset(auth()->user()->trainer) ? auth()->user()->trainer->unreadNotifications->count() : "") }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">{{ __('Notifications') }}</span>
                                </h6>
                            </li>
                        @if (Auth::user()->can('see-trainers'))
                            @foreach (auth()->user()->trainer->unreadNotifications as $notification)
                                <a href="{{ route('tests.index') }}">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">{{ $notification->data['title'] }}</h6>
                                            <small>
                                                <time class="media-meta text-muted" datetime="">{{ $notification->created_at }}</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        @if (Auth::user()->can('see-trainees'))
                            @foreach (auth()->user()->trainee->unreadNotifications as $notification)
                                @if ($notification->data['title'] == config('constants.notification.course_expired'))
                                <a href="{{ route('trainee.trainee_schedule') }}">
                                @endif
                                @if ($notification->data['title'] == config('constants.notification.test_result'))
                                <a href="{{ route('trainees.show_test') }}">
                                @endif
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">{{ $notification->data['title'] }}</h6>
                                            <small>
                                                <time class="media-meta text-muted" datetime="">{{ $notification->created_at }}</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
