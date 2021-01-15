@extends('profile.layout')
@section('title', $request->supplement->id? 'ویرایش': 'ایجاد')
@php
    if ($request->from == 'profile'){
        $action = empty($request->supplement->id)? route('profile.supplement.action', ['store']):
            route('profile.supplement.update', [$request->supplement, 'store']);
    }else{
        $action = empty($request->supplement->id)? route('admin.users.supplement.action', [$request->user, 'store']):
            route('admin.users.supplement.update', [$request->user, $request->supplement, 'store']);
    }

    $copy_bank_information_from_profile = (bool) $request->settings->grab('other')->grab(0)->get('copy_bank_information_from_profile');
@endphp
@section('content')
    @component('components.sheet',[
        'header' =>  $request->supplement->id? 'ویرایش': 'ایجاد',
        'backlink' => $request->from == 'profile'? route('profile.supplement.form'): 
            route('admin.users.supplement.form', [$request->user]),
        'padding' => true
    ])
        @component('components.form',[
            'action' => $action,
            'method' => 'POST',
        ])
            <div class="row">

                @if(\Auth::user()->accesses('users', true))
                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'نام',
                            'name' => 'name',
                            'value' => old('name', $request->supplement->name ?? $request->user->name ) ])
                        @endcomponent
                    </div>
                    
                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'نام خانوادگی',
                            'name' => 'family',
                            'value' => old('family', $request->supplement->family ?? $request->user->family ) ])
                        @endcomponent
                    </div>
                    
                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'نام پدر',
                            'name' => 'father',
                            'value' => old('father', $request->supplement->father ?? $request->user->father_name ) ])
                        @endcomponent
                    </div>

                    <div class="col s6">
                        @component('components.form.date',[
                            'label' => 'تاریخ تولد',
                            'min' => "1300/1/1",
                            'max' => jdate('tomorrow')->format('Y/m/d'),
                            'name' => 'birth_date',
                            'value' => old('birth_date', jdate($request->supplement->birth_date ?? $request->user->birthdate)->format('Y/m/d')) ])
                        @endcomponent
                    </div>
                                        
                    <div class="col s6">
                        @component('components.form.select',[ 'label' => 'وضعیت تاهل',
                            'name' => 'marital',
                            'options' => enum('supplement.marital')->pluck('label', 'id'),
                            'select_item' => old('marital', $request->supplement->marital ?? $request->user->marital) ])
                        @endcomponent                        
                    </div>

                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'کد ملی',
                            'name' => 'national_id',
                            'value' => old('national_id', $request->supplement->national_id ?? $request->user->national_id ),
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
                    
                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'شماره شناسنامه',
                            'name' => 'id_number',
                            'value' => old('id_number', $request->supplement->id_number ?? $request->user->bc_id ) ])
                        @endcomponent
                    </div>

                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'تلفن همراه',
                            'name' => 'mobile',
                            'value' => old('mobile', $request->supplement->mobile ?? $request->user->mobile ) ])
                        @endcomponent
                    </div>

                    <div class="col s6">
                        @component('components.form.select',[ 'label' => 'نسبت',
                            'name' => 'relation',
                            'options' => $request->settings->grab('relations')->pluck('label', 'id'),
                            'select_item' => old('relation', $request->supplement->relation) ])
                        @endcomponent                        
                    </div>

                    <div class="col s6">
                        @component('components.form.select',[ 'label' => 'تحت تکفل',
                            'name' => 'commitment',
                            'options' => enum('supplement.commitment')->pluck('label', 'id'),
                            'select_item' => old('commitment', $request->supplement->commitment) ])
                        @endcomponent                        
                    </div>

                    <div class="col s6">
                        @component('components.form.select',[ 'label' => 'نوع استخدام',
                            'name' => 'employment_type',
                            'options' => enum('user.employment_types')->pluck('label','id'),
                            'select_item' => old('employment_type', $request->supplement->employment_type)])
                        @endcomponent                
                    </div>                    
                    
                @endif

                <div class="col s6">
                    @component('components.form.date',[
                        'label' => 'تاریخ استخدام',
                        'name' => 'date_of_employment',
                        'value' => old('date_of_employment', $request->supplement->date_of_employment ? GSTOJS($request->supplement->date_of_employment) : ''),
                        'min' => '1363/1/1',
                        'max' => jdate('tomorrow')->format('Y/m/d'),
                        ])
                    @endcomponent
                </div>                

                <div class="col s6">
                    @component('components.form.select',[ 'label' => 'نوع بیمه تکمیلی',
                        'name' => 'supplement_insurance_type', 'select_item' => old('supplement_insurance_type'),
                        'options' => $request->settings->grab('plans')->where('active', true)->pluck('name','id'),
                        'select_item' => old('supplement_insurance_type', $request->supplement->type) ])
                    @endcomponent
                </div>
                <div class="col s6">
                    @component('components.form.select',['label' => 'بیمه گر پایه',
                        'name' => 'main_insurer_company', 'select_item' => old('main_insurer_company'),
                        'options' => $request->settings->grab('main_insurer_companies')->where('active', true)->pluck('label','id'),
                        'select_item' => old('main_insurer_company', $request->supplement->main_insurer_company) ])
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
                            'value' => old('bank_account_number', $request->supplement->bank_account_number ?? $request->user->bank_account ?? $request->user->bank_account) ])
                        @endcomponent 
                    </div>

                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'شماره شبا',
                            'name' => 'sheba', 'class' => 'sheba',
                            'value' => old('sheba', sheba_code_builder($request->supplement->bank_account_number ?? $request->user->bank_account ?? $request->user->bank_account)) ])
                        @endcomponent
                    </div>

                    <div class="col s6">
                        @component('components.form.text',[ 'label' => 'صاحب حساب', 'name' => 'bank_account_owner',
                            'value' => old('bank_account_owner', $request->user->fullname ?? $request->user->fullname) ])
                        @endcomponent
                    </div>
                    
                @endif

            </div>
            @component('components.form.button',[
                'type' => 'submit',
                'label' => 'ذخیره اطلاعات',
            ])                
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