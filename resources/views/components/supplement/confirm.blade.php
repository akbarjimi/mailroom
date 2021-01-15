@extends('profile.layout')
@php
    switch ($request->form) {
        case 'history': $title = 'تاریخچه در خواست ها'; break;
        case 'confirm': $title = 'تایید درخواست های بیمه'; break;
        case 'commit': $title = 'اعمال درخواست های فرهنگی ' . $request->user->fullName; break;
        default: $title = 'تایید'; break;
    }
@endphp
@section('content')
    @component('components.sheet',[ 'padding' => true,
        'header' => $title,
        'backlink' => $request->from == 'profile'? route('profile.supplement.form'): 
            route('admin.users.supplement.form', [$request->user]),
    ])
        
        @if (in_array($request->form, ['confirm','history', 'unconfirm', 'commit']))
            <table>
                <thead><tr>
                    <th>منطقه</th>
                    <th>نام</th>
                    <th>نسبت</th>
                    <th>کد ملی</th>
                    <th>نوع درخواست</th>
                    <th>تاریخ درخواست</th>
                </tr></thead>
                <tbody>
                @php
                    if($request->form == 'history') {
                        $ids = $request->user->supplements->whereIn('status', enum('supplement.status')->only(['history'])->pluck('id'));
                    } else {                        
                        $ids = $request->user->supplements->whereIn('status', enum('supplement.status')->only(['temp', 'lock'])->pluck('id'));
                    }
                @endphp    
                @foreach ($ids as $supplement)
                    @component('components.tr',[
                        'columns' => [
                            regions()->firstWhere('id', $supplement->region_id)['name'],
                            $supplement->fullName,
                            collect(settings('supplement_insurance.relations'))->firstWhere('id', $supplement->relation)['label'],
                            $supplement->national_id,
                            enum('supplement.action')->firstWhere('id', $supplement->action)['label'],
                            jdate($supplement->created_at)->format('l j F Y ساعت H:m:i'),
                        ],
                        'href' => $request->from == 'admin'?
                            route('admin.users.supplement.edit', [$request->user, $supplement, 'show']):
                            route('profile.supplement.edit', [$supplement, 'show']),
                    ])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
            <br/>
            <strong>قابل توجه همکاران زن: </strong> شما میتوانید به تنهایی یا به اتفاق تمام فرزندان خود تحت پوشش بیمه درمان قرار گیرید. <br>
            <strong>قابل توجه همکاران مرد: </strong> حتما تمام اعضای درجه یک خانواده خود را بیمه کنید. اعضای درجه یک شامل همسر(ان) و فرزندان میشوند. <br>
            <strong>قابل توجه کلیه همکاران: </strong> فرزندان شما در صورت ازدواج یا اشتغال نمیتوانند تحت پوشش بیمه قرار بگیرند.<br/><br/>
        @elseif($request->form == 'cancel')
            <strong>هشدار: </strong> در صورت حذف بیمه شده اصلی یا انصراف از بیمه تکمیلی تمام افراد تحت تکفل نیز حذف خواهند شد.
        @endif
        @component('components.form',[
            'action' => $request->from == 'profile'? route('profile.supplement.action', 'confirm'):
                route('admin.users.supplement.action', [$request->user, 'confirm']),
            'method' => 'POST',
        ])
            @if($request->form == 'delete')
                @if ($request->supplement->main_or_sub == enum('supplement.sub.main.id'))
                    حذف بیمه شد اصلی معادل با انصراف از بیمه تکمیلی می باشد. در صورت تایید، شما به همراه تمام بیمه‌شدگان تبعی خود از بیمه تکمیلی حذف خواهید شد.
                @else
                    @foreach ($request->reasons as $key => $label)
                        @component('components.form.radio', [
                            'name' => "reason_to_delete",
                            'label' => $label,
                            'value' => $key,
                        ])                    
                        @endcomponent
                    @endforeach
                @endif
            @endif
            @if ($request->form == 'confirm')
                @component('components.form.button',[ 'label' => 'ثبت نهایی درخواست ها', 'type' => 'submit' ])
                @endcomponent
            @elseif ($request->form == 'unconfirm')
                @component('components.form.button',[ 'label' => 'برگرداندن درخواست ها', 'type' => 'submit',
                    'action' => route('admin.users.supplement.action', [$request->user, 'unconfirm']) ])
                @endcomponent
            @elseif ($request->form == 'commit')
                @component('components.form.button',[ 'label' => 'اعمال درخواست ها', 'type' => 'submit',
                    'action' => route('admin.users.supplement.action', [$request->user, 'commit']) ])
                @endcomponent
            @elseif ($request->form == 'delete')
                @component('components.form.button',[
                    'label' => 'حذف',
                    'type' => 'submit',
                    'action' => $request->from == 'profile'
                        ? route('profile.supplement.update', [$request->supplement, 'delete'])
                        : route('admin.users.supplement.update', [$request->user, $request->supplement, 'delete']) ])
                @endcomponent
            @elseif ($request->form == 'cancel')
                @php
                    $main = $request->user->supplements->where('status', enum('supplement.status.active.id'))
                        ->firstWhere('main_or_sub', enum('supplement.sub.main.id'));
                @endphp                
                @component('components.form.button',[ 'label' => 'انصراف از بیمه تکمیلی', 'type' => 'submit',
                    'action' => $request->from == 'profile' ? route('profile.supplement.update', [$main, 'delete']) : route('admin.users.supplement.update', [$request->user, $main, 'delete']) ])
                @endcomponent
            @endif
        @endcomponent
    @endcomponent
@endsection