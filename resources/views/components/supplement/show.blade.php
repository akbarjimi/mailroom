@extends('profile.layout')
@section('title', $request->supplement->id? 'نمایش': 'ایجاد')
@php
    if ($request->from == 'profile'){
        $action = empty($request->supplement->id)? route('profile.supplement.action', ['store-sub']):
            route('profile.supplement.update', [$request->supplement, 'store-sub']);
    }else{
        $action = empty($request->supplement->id)? route('admin.users.supplement.action', [$request->user, 'store-sub']):
            route('profile.supplement.update', [$request->user, $request->supplement, 'store-sub']);
    }
@endphp
@section('content')
    @component('components.sheet',[ 'padding' => true,
        'header' =>  $request->supplement->id? 'نمایش': 'ایجاد',
        'backlink' => $request->from == 'profile'? route('profile.supplement.form'): 
            route('admin.users.supplement.form', [$request->user]),
    ])
        @component('components.form',[
            'action' => $action,
            'method' => 'POST',
        ])
            @php
                $constants = collect(enum('supplement'));
                $settings = collect(settings('supplement_insurance'));
            @endphp
            @component('components.show', [
                'items' => [
                    ['label' => 'بیمه‌گذار',         'value' => $request->user->fullname ],
                    ['label' => 'منطقه',            'value' => $request->supplement->region->name ],

                    ['label' => 'نام',              'value' => $request->supplement->name ],
                    ['label' => 'نام خانوادگی',     'value' => $request->supplement->family ],
                    ['label' => 'نام پدر',          'value' => $request->supplement->father ],
                    ['label' => 'تاریخ تولد',       'value' => jdate($request->supplement->birth_date)->format('d F Y') ],
                    ['label' => 'کد ملی',           'value' => $request->supplement->national_id ],
                    ['label' => 'شماره شناسنامه',   'value' => $request->supplement->id_number ],

                    ['label' => 'جنسیت',            'value' => $request->supplement->gender == enum('user.gender.man.id') ? 'مرد' : 'زن' ],
                    ['label' => 'وضعیت تاهل',       'value' => $constants->grab('marital')->firstWhere('id', $request->supplement->marital)['label'] ?? '' ],
                    ['label' => 'نسبت',             'value' => $request->settings->grab('relations')->firstWhere('id', $request->supplement->relation)['label'] ?? ''  ],
                    ['label' => 'وضعیت تکفل',       'value' => $constants->grab('commitment')->firstWhere('id', $request->supplement->commitment)['label'] ?? ''  ],
                    ['label' => 'اصلی یا تبعی',     'value' => $constants->grab('sub')->firstWhere('id', $request->supplement->main_or_sub)['label'] ?? '' ],
                    ['label' => 'تلفن همراه',       'value' => $request->supplement->mobile],
                    
                    ['label' => 'شرکت بیمه‌گر پایه', 'value' => $settings->grab('main_insurer_companies')->firstWhere('id', $request->supplement->main_insurer_company)['label'] ?? ''],
                    ['label' => 'شماره بیمه پایه',  'value' => $request->supplement->main_insurer_id ],

                    ['label' => 'بانک',             'value' => $settings->grab('banks')->firstWhere('id', $request->supplement->bank ?? $request->supplement->insurer($request->user)->bank)['label'] ??  '' ],
                    ['label' => 'نوع حساب',         'value' => "جاری"],
                    ['label' => 'صاحب حساب',        'value' => $request->supplement->bank_account_owner ?? $request->supplement->insurer($request->user)->bank_account_owner ],
                    ['label' => 'شماره حساب',       'value' => $request->supplement->bank_account_number ?? $request->supplement->insurer($request->user)->bank_account_number ],
                    ['label' => 'شماره شبا',        'value' => $request->supplement->sheba ?? $request->supplement->insurer($request->user)->sheba ],

                    ['label' => 'نوع استخدام',      'value' => enum('user.employment_types')->firstWhere('id', $request->supplement->employment_type ?? $request->supplement->insurer($request->user)->employment_type)['label'] ?? ''],
                    ['label' => 'تاریخ استخدام',    'value' => jdate($request->supplement->date_of_employment ?? $request->supplement->insurer($request->user)->date_of_employment)->format('d F Y')],
                    
                    ['label' => 'طرح بیمه',         'value' => $settings->grab('plans')->firstWhere('id', $request->supplement->type ?? $request->supplement->insurer($request->user)->type)['name'] ?? '' ],
                    ['label' => 'جزییات طرح بیمه',  'value' => implode(" - ",$request->supplement->type_info ?? $request->supplement->insurer($request->user)->type_info  ?? []) ],
                    ['label' => 'دلیل درخواست',     'value' => $settings->grab('reason_to_request')->get($request->supplement->reason_to_request)],
                    ['label' => 'وضعیت',            'value' => $constants->grab('status')->firstWhere('id', $request->supplement->status)['label'] ?? '' ],
                    ['label' => 'عملیات',           'value' => $constants->grab('action')->firstWhere('id', $request->supplement->action)['label'] ?? ''  ],
                    ['label' => 'تاریخ',            'value' => jdate($request->supplement->created_at)->format('d F Y ساعت H:i:s') ],
                ]
            ])
                
            @endcomponent

            @if(supplement_period() || $request->is_admin)
                @if($request->supplement->status == enum('supplement.status.temp.id') || $request->supplement->status == enum('supplement.status.active.id'))
                    @component('components.form.button', [
                        'type' => 'submit',
                        'label' => $request->supplement->status == enum('supplement.status.temp.id') ? 'حذف درخواست': 'حذف بیمه شده',
                        $request->supplement->status == enum('supplement.status.temp.id') ? 'action' : 'href' => ($request->from == 'profile') ? route('profile.supplement.edit', [$request->supplement, 'delete']):
                            route('admin.users.supplement.edit', [$request->user, $request->supplement, 'delete'])
                    ])
                        
                    @endcomponent

                    @component('components.form.button', [
                        'type' => 'submit',
                        'label' => 'ویرایش',
                        'href' => ($request->from == 'profile')? route('profile.supplement.update', [$request->supplement, 'edit']):
                            route('admin.users.supplement.update', [$request->user, $request->supplement, 'edit'])
                    ])
                        
                    @endcomponent
                @endif            
            @endif
        @endcomponent
    @endcomponent
@endsection