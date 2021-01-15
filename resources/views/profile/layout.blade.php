<!DOCTYPE html>
<html>
<title>@yield("title")</title>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-153790314-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-153790314-1');
</script>    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="theme-color" content="#002f6c"/>
    <link href="{{ asset('css/global.css') }}?version={{ config('app.version') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="profile {{ Auth::user()->accesses()->count() ? "admin" : "" }}">
@if (Auth::user()->accesses()->count())
    @access @component('components.admin-navigation')@endcomponent @endaccess
@endif
<div class="nav-glass untoggle-show"></div>
<div id="top-nav" class="">
    <div class="container">
        <i class="material-icons toggle-show pointer hide-on-large-only" target=".profile-nav, .nav-glass">menu</i>
        <a href="/" class="hide-on-med-and-down">
            <img src="{{ asset('images/logo.png') }}" class="right" style="height: 4rem" alt="">
        </a>
        <ul class="profile-icons nav-icons left">
            @if(isset($employee) && Auth::user()->isNot($employee))
                <li>
                    <a href="{{ route('admin.users.show',["user"	=>	$employee]) }}">
                        <span class="hide-on-small-only">{{  $employee->fullname }}</span>
                        <i class="material-icons ">person</i>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('profile.index') }}">
                        <span class="hide-on-small-only">{{  $user->fullname }}</span>
                        <i class="material-icons ">person</i>
                    </a>
                </li>
            @endif
            @if(isset($user) && Auth::user()->accesses()->isEmpty())
                <li class="">
                    <a href="{{ route('profile.notifications.index') }}">
                        @if(count($user->unreadNotifications) > 0)
                            <i class="material-icons notifications-active">notifications_active</i>
                        @else
                            <i class="material-icons ">notifications</i>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="tooltipped" data-tooltip="خروج"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="material-icons ">power_settings_new</i></a>
                </li>
            @endif
        </ul>
    </div>
</div>
@yield('content')
<ul id="slide-outxxxxx" class="collapsible profile-nav side-nav sidenav-fixedx padding-0">
    <li class="header">سامانه سرا</li>
    <li>
        <a href="{{ isset($employee) ? route('admin.users.show', $employee): route('profile.index') }}">
            <i class="material-icons">account_circle</i> پروفایل
        </a>
    </li>
    <li>
        <a href="{{ route('blog.index') }}">
            <i class="material-icons">account_circle</i> صفحه اصلی
        </a>
    </li>
    {{-- @isset($employee)
        <li>
            <a href="{{ route('admin.users.log',$employee) }}">
                <i class="material-icons">track_changes</i> تغییرات پروفایل
            </a>
        </li>
    @endisset --}}

    <li>
        <a href="{{ isset($employee)? route('admin.users.invoices', $employee): route("profile.invoices.index") }}">
            <i class="material-icons">assignment</i>
            صورت حسابها
        </a>
    </li>

    <li>
        <a href="{{ isset($employee)? route('admin.users.bills', $employee): route("profile.bills.index") }}">
            <i class="material-icons">payment</i>
            کسورات
        </a>
    </li>

    <li>
        <a href="{{ isset($employee)? route('admin.users.news', $employee): route("profile.news.index") }}">
            <i class="material-icons">new_releases</i>
            اخبار
        </a>
    </li>

    <li>
        <a href="#!" class="collapsible-header">
            <i class="material-icons">restaurant_menu</i>
            خدمات رفاهی
            <i class="material-icons left">chevron_left</i>
        </a>
        <ul class="collapsible-body">
            <li>
                <a href="{{ isset($employee)? route('admin.users.forms.index', $employee) :route('profile.forms.index') }}">فرم
                    های درخواست</a></li>
            <li>
                <a href="{{ isset($employee)? route('admin.users.letters.index', $employee) :route('profile.letters.index') }}">
                    معرفی نامه ها
                </a></li>
        </ul>
    </li>

    <li>
        <a href="#!" class="collapsible-header">
            <i class="material-icons">local_hotel</i> مراکز اسکان
            <i class="material-icons left">chevron_left</i>
        </a>

        <ul class="collapsible-body">
            <li>
                <a href="{{ isset($employee)? route('admin.users.reserve', $employee): route('profile.reserve') }}">
                    رزرو مراکز اقامتی
                </a>
            </li>
            <li>
                <a href="{{ isset($employee)? route('admin.users.reserves', $employee): route('profile.reserves.index') }}">
                    رزروها
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ isset($employee)	? route('admin.users.conversations', $employee): route('profile.conversations.index') }}">
            <i class="material-icons">inbox</i>
            مکاتبات و پشتیبانی
        </a>
    </li>

    @if(!isset($employee) && Auth::user()->isSchoolManager())
        <li>
            <a href="{{ route('profile.schools.index') }}">
                <i class="material-icons">school</i>
                حوادث دانش آموزی
            </a>
        </li>
    @endif

    <li>
        <a href="{{ isset($employee)? route('admin.users.supplement.form', $employee): route('profile.supplement.form') }}">
            <i class="material-icons">local_hotel</i>
            بیمه تکمیلی
        </a>
    </li>

    <li>
        <a href="{{ isset($employee) ? route('admin.users.edit.contact', $employee): route('profile.edit.contact') }}">
            <i class="material-icons">edit</i>
            ویرایش حساب کاربری
        </a>
    </li>

    @if( ! isset($employee) )
        <li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="material-icons">power_settings_new</i>
                خروج از حساب کاربری
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">{{ csrf_field() }}</form>
        </li>
    @endif
    {{-- <p class="container caption contact-info-sidenav">
        تهران بزرگراه بعثت  خ شهید بخارایی خ شهید سمیعی مقابل درب شمالی پارک بعثت<br>
        تلفن: ۵۵۰۴۱۱۰۲<br>
        کد پستی :۱۱۸۷۶۱۳۹۱۱
    </p> --}}
</ul>
@php 
    $alerts = $alerts ?? session('alerts', []); 
    $alert_count = 0;
    foreach ($alerts as $alert_type) $alert_count += count($alert_type);
@endphp

@if($alert_count)
    <div class="global-alerts shadow">
        @foreach ($alerts as $alert_type => $alert_list)
            <div class="alert {{ $alert_type }}">
                <img src="{{ asset('images/danger.png') }}" alt="">
                <div class="alert-list">
                    <i class="material-icons left pointer">close</i>
                    <ul>
                        @foreach ($alert_list as $alert)
                            <li>{{ $alert }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    <div class="global-alerts">
        @foreach ($alerts as $alert_type => $alert_list)
            <div class="alert {{ $alert_type }} pulse">
                <img src="{{ asset('images/'. $alert_type .'.png') }}" alt="">
                <div class="alert-list">
                    <i class="material-icons left pointer">close</i>
                    <ul>
                        @foreach ($alert_list as $alert)
                            <li>{{ $alert }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    @php Session::forget('alerts') @endphp
@endif
{{-- start jalali calendar modal--}}
<div id="jdatemodal" class="modal">
    <div class="header title">
        <span class="right padding-right pointer"><i class="material-icons white-text">chevron_right</i></span>
        <span class="left padding-left pointer"><i class="material-icons white-text">chevron_left</i></span>
        <span class='jdatemodal-month pointer'></span>
        -
        <span class='jdatemodal-year pointer'></span>
    </div>
    <div class="modal-contentx padding">
        <table>
            <thead>
            <tr>
                <th width="14.2%">ش</th>
                <th width="14.2%">ی</th>
                <th width="14.2%">د</th>
                <th width="14.2%">س</th>
                <th width="14.2%">چ</th>
                <th width="14.2%">پ</th>
                <th width="14.2%">ج</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="modal-list month">
        <ul id="jdatemodal-month"></ul>
    </div>
    <div class="modal-list year">
        <ul id="jdatemodal-year"></ul>
    </div>
</div>
{{-- end jalali calendar modal--}}
<script src="{{ asset('js/app.js') }}?version={{ config('app.version') }}"></script>
</body>
</html>
