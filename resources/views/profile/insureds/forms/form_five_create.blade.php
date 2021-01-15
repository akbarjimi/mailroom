@extends('profile.layout')
@section('title',$use_as_form_six ? 'فرم شماره ۶' : 'فرم شماره ۵')
@section('content')
    @component('components.sheet',[
      'header' => $use_as_form_six ? 'فرم شماره ۶' : 'فرم شماره ۵',
      'backlink' => route('profile.schools.insureds.forms.index', [$school, $insured]),
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'method' => 'POST',
          'action' => route('profile.schools.insureds.forms.store', [
                $school,
                $insured,
                'type' => $use_as_form_six ? Letter::FORM_SIX : Letter::FORM_FIVE,
          ])
        ])
            @component('components.form.label', [
                'key' => 'بیمه شده',
                'value' => $insured->fullname
            ])
            @endcomponent
            <div class="row">
                @foreach($documents as $id => $label)
                    @component('components.form.checkbox',[
                        'name' => "documents[]",
                        'value' => $id,
                        'label' => $label,
                        'checked' => in_array($id, old('documents',[])),
                        'class' => 'col s2.5',
                    ])
                    @endcomponent
                @endforeach
            </div>
            <div>
                @component('components.form.date', [
                    'max' => jdate('+1 day')->format("Y/m/d"),
                    'name' => 'date',
                    'label' => 'تاریخ حادثه',
                    'value' => old('date'),
                ])
                @endcomponent
            </div>
            <div>
                @component('components.form.textarea', [
                    'name' => 'description',
                    'label' => 'شرح حادثه',
                    'value' => old('description'),
                ])
                @endcomponent
            </div>

            <div>
                    @component('components.form.label',[
                        'key' => 'توضیحات ',
                        'value' => 'شماره حساب باید متعلق به بیمه شده، پدر یا سرپرست قانونی ایشان باشد.',
                    ])
                        
                    @endcomponent
            </div>

            <div>
                @component('components.form.textarea', [
                    'name' => 'bank_account',
                    'label' => 'شماره حساب جهت پرداخت تعهد بیمه‌گر',
                    'value' => old('bank_account'),
                ])
                @endcomponent
            </div>
            
            
            <div>
                @component('components.form.textarea', [
                    'name' => 'bank',
                    'label' => 'بانک عامل شماره حساب',
                    'value' => old('bank'),
                ])
                @endcomponent
            </div>                

            <div>
                @component('components.form.textarea', [
                    'name' => 'bank_account_owner',
                    'label' => 'نام و نام خانوادگی صاحب حساب ',
                    'value' => old('bank'),
                ])
                @endcomponent
            </div>

            <div>
                    @component('components.form.label',[
                        'key' => 'توضیحات ',
                        'value' => 'در صورتی که بیمه شده صاحب حساب می باشد، نیازی به پر کردن "نسبت صاحب حساب با بیمه شده" نمی باشد.',
                    ])
                        
                    @endcomponent
            </div>            

            <div>
                @component('components.form.textarea', [
                    'name' => 'bank_account_owner_relation',
                    'label' => 'نسبت صاحب حساب با بیمه شده',
                    'value' => old('bank_account_owner_relation'),
                ])
                @endcomponent
            </div>            


            <div>
                @component('components.form.textarea', [
                    'name' => 'total_costs',
                    'label' => 'مبلغ کل هزینه های پرداخت شده به ریال',
                    'value' => old('total_costs'),
                ])
                @endcomponent
            </div>            
            
            @if (in_array($insured->type, [Insured::REFUGEES, Insured::STUDENTS_EVENTS])))
            <div>
                    @component('components.form.textarea', [
                        'name' => 'father_or_who_has_custody',
                        'label' => 'نام و نام خانوادگی ولی یا قیم بیمه شده',
                        'value' => old('father_or_who_has_custody'),
                    ])
                    @endcomponent
                </div>                                        
            @endif

            <div>
                @component('components.form.textarea', [
                    'name' => 'mobile',
                    'label' => 'شماره تلفن همراه',
                    'value' => old('mobile'),
                ])
                @endcomponent
            </div>                              

            <div>
                @component('components.form.textarea', [
                    'name' => 'tel',
                    'label' => 'شماره تلفن ثابت (در صورت نبود تلفن همراه)',
                    'value' => old('tel'),
                ])
                @endcomponent
            </div>                                      
            @component('components.form.button',[
              'label' => 'ذخیره',
            ])
            @endcomponent
            @component('components.form.button',[
              'label' => 'انصراف',
              'href' => route('profile.schools.insureds.forms.index', [$school , $insured]),
              'flat' => true
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
