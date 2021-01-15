@extends('profile.layout')
@php
    if ($request->from == 'profile'){
        $action = empty($request->supplement->id) ? route('profile.supplement.action', ['store-sub']):
        route('profile.supplement.update', [$request->supplement, 'store-sub']);
    } else {
        $action = empty($request->supplement->id)
        ? route('admin.users.supplement.action', [$request->user, 'store-sub'])
        : route('admin.users.supplement.update', [$request->user, $request->supplement, 'store-sub']);
    }

    $copy_bank_information_from_profile = (bool) $request->settings->grab('other')->grab(0)->get('copy_bank_information_from_profile');    
@endphp
@section('content')
    @component('components.sheet',[ 'padding' => true,
        'header' =>  $request->supplement->id? 'ویرایش': 'ایجاد',
        'backlink' => $request->from == 'profile'? route('profile.supplement.form'): 
            route('admin.users.supplement.form', [$request->user]),
    ])
        @component('components.form',[
            'action' => $action,
            'method' => 'POST',
        ])
            <div class="row">
                <div class="col s6">
                    @component('components.form.text',[ 'label' => 'نام', 
                        'name' => 'name', 'value' => old('name', $request->supplement->name) ]) @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.text',[ 'label' => 'نام خانوادگی',
                        'name' => 'family', 'value' => old('family', $request->supplement->family) ]) @endcomponent
                </div> 
                <div class="col s6">
                    @component('components.form.text',[ 'label' => 'نام پدر',
                        'name' => 'father', 'value' => old('father', $request->supplement->father) ]) @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.date',[
                        'label' => 'تاریخ تولد',
                        'min' => "1300/1/1",
                        'max' => jdate('tomorrow')->format('Y/m/d'),
                        'name' => 'birth_date',
                        'value' => old('birth_date', GSTOJS($request->supplement->birth_date))
                    ])
                    @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.select',[ 'label' => 'وضعیت تاهل',
                        'name' => 'marital', 'select_item' => old('marital'),
                        'options' => enum('supplement.marital')->pluck('label', 'id'),
                        'select_item' => old('marital', $request->supplement->marital) ]) @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.text',[ 'label' => 'کد ملی',
                        'name' => 'national_id',
                        'value' => old('national_id', $request->supplement->national_id ),
                        'disabled' => $disabled = $request->supplement->status != enum('supplement.status.temp.id'),
                    ])
                    @endcomponent
                    @if($disabled)
                        @component('components.form.label', [
                            'key' => 'توضیحات',
                            'value' => 'کد ملی در فرم ویرایش قابل تغییر نیست.',
                        ])
                            
                        @endcomponent
                    @endif
                </div>                
                <div class="col s12"></div>
                <div class="col s6">
                    @component('components.form.text',['label' => 'شماره شناسنامه',
                        'name' => 'id_number', 'value' => old('id_number', $request->supplement->id_number)]) @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.text',[ 'label' => 'تلفن همراه',
                        'name' => 'mobile', 'value' => old('mobile', $request->supplement->mobile)])@endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.select',[ 'label' => 'نسبت',
                        'name' => 'relation', 'select_item' => old('relation'),
                        'options' => $request->settings->grab('relations')->where('active', true)->reject(function ($relation) use ($request) {
                            return      $relation['gender'] == enum('supplement.relation.main.value')
                                    || ($request->user->gender == enum('user.gender.man.id') && $relation['gender'] == enum('supplement.relation.husband.value'))
                                    || ($request->user->gender == enum('user.gender.woman.id') && $relation['gender'] == enum('supplement.relation.wife.value'));
                        })->pluck('label', 'id'),
                        'select_item' => old('relation', $request->supplement->relation)
                    ])
                    @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.select',[ 'label' => 'وضعیت تکفل',
                        'name' => 'commitment', 'value' => old('commitment'),
                        'options' => enum('supplement.commitment')->pluck('label', 'id'),
                        'select_item' => old('commitment', $request->supplement->commitment)]) @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.select',['label' => 'بیمه گر پایه',
                        'name' => 'main_insurer_company', 
                        'select_item' => old('main_insurer_company', $request->supplement->main_insurer_company),
                        'options' => $request->settings->grab('main_insurer_companies')->where('active', true)->pluck('label','id') ])
                    @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.text',[ 'label' => 'شماره دفترچه بیمه',
                        'name' => 'main_insurer_id', 'value' => old('main_insurer_id', $request->supplement->main_insurer_id) ])
                    @endcomponent
                </div>

                @if($copy_bank_information_from_profile == false || !empty(\Auth::user()->accesses('users', true)))
                    <div class="col s6">
                        @component('components.form.select',[ 'label' => 'بانک',
                            'name' => 'bank', 'select_item' => old('bank'),
                            'options' => $request->settings->grab('banks')->where('active', true)->pluck('label','id'),
                            'select_item' => old('bank', $request->supplement->bank)])
                        @endcomponent
                    </div>

                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'شماره حساب بانکی',
                            'name' => 'bank_account_number', 'class' => 'bank_account_number',
                            'value' => old('bank_account_number', $request->supplement->bank_account_number ?? $request->user->bank_account) ])
                        @endcomponent 
                    </div>

                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'شماره شبا',
                            'name' => 'sheba', 'class' => 'sheba',
                            'value' => old('sheba', sheba_code_builder($request->supplement->bank_account_number ?? $request->user->bank_account)) ])
                        @endcomponent
                    </div>

                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'صاحب حساب', 'name' => 'bank_account_owner',
                            'value' => old('bank_account_owner', $request->user->fullname ?? $request->user->fullname) ])
                        @endcomponent
                    </div>
                    
                @endif
            </div>
            @component('components.form.button',[ 'label' => 'ذخیره اطلاعات',
                'type' => 'submit' ])
            @endcomponent
            @component('components.form.button', [
                'label' => 'برگشت',
                'href' => $request->from == 'profile'
                    ? route('profile.supplement.edit', [$request->supplement, 'show'])
                    : route('admin.users.supplement.edit',[ $request->user, $request->supplement, 'show']),
            ])
                
            @endcomponent

        @endcomponent
    @endcomponent
@endsection