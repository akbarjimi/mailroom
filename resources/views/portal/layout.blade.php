<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="theme-color" content="#002f6c"/>
    <meta name="test" content="blade-ok">
    <title>مدیریت نامه ها</title>
    <link href="{{ asset('css/global.css') }}?version={{ config('app.version') }}" rel="stylesheet">
</head>
<body class="portal admin">
@component('components.admin-navigation')@endcomponent
<div class="nav-glass untoggle-show"></div>
<div class="container large min-height">
    @yield('topbar')
    <div class="row side-align">
        <div class="col m8-4 s12">
            @yield('content')
        </div>
        <div class="col m3-6 s12">
            @yield('sidebar')
            {{-- <div class="white margin-bottom padding z-depth-1 radius">
                @php
                    $statistic = Cache::get('refah-statistic', ['today' => 580, 'all' => 12385]);
                    if(rand(0,10) > 7){
                        Cache::forget('refah-statistic');
                        $statistic['today'] ++;
                        $statistic['all'] ++;
                    }
                    Cache::rememberForever('refah-statistic', function()use($statistic){return $statistic;});
                @endphp
                بازدید کل: {{ $statistic['all'] }} نفر<br>
                بازدید امروز: {{ $statistic['today'] }} نفر
            </div> --}}
            @isset($side_posts)
                <div class="col s12 white padding-right-0 padding-left-0 z-depth-1 radius margin-bottom">
                    @foreach ($side_posts as $side_post)
                        <div class="col s12 border-bottom padding-v-half">
                            <div class="col s4 padding-right-0">
                                <a href="{{ route('blog.post', $side_post) }}">
                                    @if ($side_post->getMedia('post-banner')->count())
                                        <img src="{{ $side_post->getFirstMediaUrl('post-banner', 'thumb') }}" alt="">
                                    @else
                                        <img src="/images/post/thumb.jpg" alt="{{ $side_post->title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="col s8 padding-right-0 padding-left-0">
                                <h2 class="margin-0 title body2">
                                    <a class="text-color"
                                       href="{{ route('blog.post', $side_post ) }}">{{ $side_post->title }}</a>
                                </h2>
                                <div class="caption">
                                    {{ jdate($side_post->created_at)->format('j F Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisset
            @if(request()->route()->uri ?? '' == '/')
                <script src="http://prayer.horuph.com/frame/?color0=212121&color1=226699&bgcolor=FAFAFA&inbgcolor=FFFFFF&az=1&tz=0&bdcolor=C4C4C4&border=1&curved=7&city=8-3" type="text/javascript" language="javascript"></script>
            @endif

        </div>

    </div>
</div>
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
<script src="{{ asset('js/app.js') }}?version={{ config('app.version') }}"></script>
</body>
</html>
