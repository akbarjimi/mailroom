@extends( 'profile.layout')
@section('title', 'درخواست های بیمه')
@section('content')
    @if($request->from == 'admin')
        @component('components.sheet',['padding' => true])
            <div class="row">
                <div class="col l2 m6 s12">
                    <div class="image-cropper valign-wrappe center-align">
                        @if($request->user->avatar)
                            <img src="/storage/avatars/{{ $request->user->avatar }}" alt="" class="circle z-depth-1">@else
                            <i class="material-icons large secondary-light white-text circle padding">person</i>@endif
                    </div>
                </div>
            <div class="col pull-l1 l4 m6 s12">
                <h2 class="title">{{ $request->user->fullname }}</h2>
                @component('components.form.label',['key' => 'تراز مالی', 'value' =>  $request->user->balance()])@endcomponent
                @component('components.form.label',['key' => 'خالص دریافتی', 'value' => $request->user->net_income])@endcomponent
                @if($request->user->supplements->where('status', enum('supplement.status.history.id'))->isNotEmpty())
                    @component('components.form.button', [
                        'label' => 'نمایش تاریخچه',
                        'href' => route('admin.users.supplement.form', [$request->user, 'history']),
                        'flat' => true,
                    ])
                    @endcomponent
              @endif                
            </div>
            <div class="col l3 m6 s12">
                @component('components.form.label',['key' => 'کد پرسنلی', 'value' => $request->user->code])@endcomponent
                @component('components.form.label',['key' => 'کد ملی', 'value' => $request->user->national_id])@endcomponent
                @component('components.form.label',['key' => 'محل خدمت', 'value' => $request->user->region->name])@endcomponent
                @component('components.form.label',['key' => 'تاریخ تولد', 'value' => strtotime($request->user->birthdate) ? 
                    GSTOJS($request->user->birthdate) : ''])@endcomponent
            </div>
            <div class="col l3 m6 s12">
                @component('components.form.label',['key' => 'تلفن ثابت', 'value' => $request->user->tel])@endcomponent
                @component('components.form.label',['key' => 'تلفن همراه', 'value' => $request->user->mobile])@endcomponent
            </div>
        </div>
    @endcomponent
    @endif

    
    @if ($request->user->supplements->where('status', enum('supplement.status.active.id'))->isNotEmpty())
        @component('components.sheet',[
            'header' =>  'اطلاعات فعلی بیمه',
        ])
            <table>
                <thead><tr>
                    <th>واحد سازمانی</th><th>نام</th><th>کد ملی</th>
                </tr></thead>
                <tbody>
                    @foreach ($request->user->supplements->where('status', enum('supplement.status.active.id')) as $supplement)
                        @component('components.tr',[
                            'columns' => [
                                regions()->firstWhere('id', $supplement->region_id)['name'],
                                $supplement->fullName,
                                $supplement->national_id,
                            ],
                            'href' => $request->from == 'admin'?
                                route('admin.users.supplement.edit', [$request->user, $supplement, 'show']):
                                route('profile.supplement.edit', [$supplement, 'show']),
                        ])
                        @endcomponent
                    @endforeach
                </tbody>
            </table>
            @unless($request->insurer_terminate_contract)
                <div class="padding">
                    @component('components.chip', [ 'label' => 'انصراف از بیمه تکمیلی', 'icon' => 'remove', 'active' => true,
                        'href' => $request->from == 'profile'? route('profile.supplement.form', 'cancel'):
                            route('admin.users.supplement.form', [$request->user, 'cancel']),
                    ])@endcomponent
                </div>
            @endunless
        @endcomponent
    @endif
    
    
    @component('components.sheet',['header' =>  'درخواست های بیمه',])
        @if ($request->user->supplements->whereIn('status', [enum('supplement.status.temp.id'), 
            enum('supplement.status.lock.id')])->isNotEmpty())
            <table>
                <thead><tr>
                    <th>منطقه</th>
                    <th>نام</th>
                    <th>نسبت</th>
                    <th>کد ملی</th>
                    <th>نوع درخواست</th>
                </tr></thead>
                <tbody>
                @foreach ($request->user->supplements->whereIn('status', [enum('supplement.status.temp.id'), 
                    enum('supplement.status.lock.id')]) as $supplement)
                    @component('components.tr',[
                        'columns' => [
                            regions()->firstWhere('id', $supplement->region_id)['name'],
                            $supplement->fullName,
                            collect(settings('supplement_insurance.relations'))->firstWhere('id', $supplement->relation)['label'],
                            $supplement->national_id,
                            enum('supplement.action')->firstWhere('id', $supplement->action)['label']
                        ],
                        'href' => $request->from == 'admin'?
                            route('admin.users.supplement.edit', [$request->user, $supplement, 'show']):
                            route('profile.supplement.edit', [$supplement, 'show']),
                    ])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        @endif
        <div class="padding">
            @if ($request->user->supplements->whereNotIn('status', [enum('supplement.status.history.id')])
                ->where('main_or_sub', enum('supplement.sub.main.id'))->isEmpty())
                @component('components.chip', [ 'label' => 'درخواست بیمه', 'icon' => 'add', 'active' => true,
                    'href' => $request->from == 'profile'? route('profile.supplement.form', 'create'):
                        route('admin.users.supplement.form', [$request->user, 'create']),
                ])
                @endcomponent
            @else
                @if ($request->user->supplements->where('status', enum('supplement.status.lock.id'))->isNotEmpty())
                    @component('components.form.button', [
                        'label' => 'چاپ',
                        'icon' => 'print',
                        'flat' => true,
                        'target' => "_blank",
                        'href' => $request->from == 'profile'
                            ? route('profile.supplement.print')
                            : route('admin.users.supplement.print', $request->user),
                    ])
                    @endcomponent
                    @if($request->from == 'admin')
                        @component('components.chip', [ 'label' => 'اعمال درخواست ها', 'icon' => 'check', 'active' => true,
                            'href' => route('admin.users.supplement.form', [$request->user, 'commit'])
                        ])@endcomponent
                        @component('components.chip', [ 'label' => 'برگرداندن درخواست ها', 'icon' => 'check', 'active' => true,
                            'href' => route('admin.users.supplement.form', [$request->user, 'unconfirm'])
                        ])@endcomponent
                    @endif
                @else
                    @component('components.chip', [ 'label' => 'افزودن اعضای خانواده', 'icon' => 'add', 'active' => true,
                        'href' => $request->from == 'profile'? route('profile.supplement.form', 'create_sub'):
                            route('admin.users.supplement.form', [$request->user, 'create_sub']),
                    ])@endcomponent
                    @if ($request->user->supplements->where('status', enum('supplement.status.temp.id'))->isNotEmpty())
                        @component('components.chip', [ 'label' => 'ثبت نهایی درخواست', 'icon' => 'check', 'active' => true,
                            'href' => $request->from == 'profile'? route('profile.supplement.form', 'confirm'):
                                route('admin.users.supplement.form', [$request->user, 'confirm'])
                        ])@endcomponent
                    @endif
                @endif                
            @endif
        </div>
    @endcomponent

    
@endsection