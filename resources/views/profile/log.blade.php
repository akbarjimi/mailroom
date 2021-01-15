@extends('profile.layout')
@section('content')
    @component('components.sheet',['header' =>  'تغییرات اخیر'])
        <div class="padding">
            <div class="left">
                {{ $logs->appends(request()->input())->links('components.table-pagination', ['results' => $logs, 'per_page' => true]) }}
            </div>
            <div class="clearfix"></div>
        </div>
        <table id="log">
            <thead>
            <tr>
                <th>تغییردهنده</th>
                <th>زمان</th>
                <th>عملیات</th>
                <th>جزییات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->maker->fullname or 'سیستمی' }}</td>
                    <td>{{ $log->created_at->diffForHumans()}}</td>
                    <td>{{ $actions[$log->action] ?? '' }}</td>
                    <td>
                        <a href="#" class="pointer toggle-btn" target=".toggle-{{ $log->id }}">
                            جزئیات
                            <i class="tiny material-icons margin-left">info</i>
                        </a>
                    </td>
                </tr>
                <tr class="togglable close toggle-{{ $log->id }}">
                    <td colspan="4">
                        @forelse($log->extra as $action => $detail)
                            {{ $actions[$log->action] ?? '' }}
                            @foreach($detail as $key => $value)
                                <div class="margin-half-h" dir="rtl">
                                    {{ __('validation.attributes.'.$key) }} : {{ $value }}
                                </div>
                            @endforeach
                            <hr>
                        @empty
                             اطلاعات اضافی موجود نیست
                        @endforelse
                    </td>
                </tr>
            @empty
                <td colspan="4" class="center-align">
                    تغییراتی موجود نیست
                </td>
            @endforelse
            </tbody>
        </table>
        <div class="padding">
            <div class="left">
                {{ $logs->appends(request()->input())->links('components.table-pagination', ['results' => $logs, 'per_page' => true]) }}
            </div>
            <div class="clearfix"></div>
        </div>
        </div>
    @endcomponent
@endsection