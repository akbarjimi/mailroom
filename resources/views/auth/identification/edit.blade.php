@extends('admin.layout')
@section('title', 'شناسایی اولیه')
@section('content')
    @component('components.sheet', [
      'header'    => "{$name} عزیز لطفا اطلاعات خود را تکمیل کنید",
      'padding'   => TRUE,
      'medium'    => TRUE,
    ])
        @component('components.form.label',[
            'key' => 'توضیحات',
            'value' => 'فرم یکبار مصرف',
        ])
        @endcomponent
        @component('components.form', ['action' => route('identity.update'), 'method' => 'POST'])
            @component('components.form.text', [
              'name' => 'code',
              'label' => 'کد پرسنلی یا کد دفتر کل',
              'value' => old('code', $code),
              'hidden' => true,
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'bc_id',
              'label' => 'شماره شناسنامه',
              'value' => old('bc_id')
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'bank_account',
              'label' => 'شماره حساب بانکی',
              'value' => old('bank_account')
            ])
            @endcomponent
            @component('components.form.date', [
              'name'  =>  'birthdate',
              'label' =>  'تاریخ تولد به صورت 1300/01/01',
              'min'   =>  '1300/01/01',
              'max'   =>  GSTOJS(now()->toDateString()),
              'value' =>  old('birthdate')
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'mobile',
              'label' => 'تلفن همراه',
              'value' => old('mobile')
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'password',
              'label' => 'رمز عبور حداقل 6 و حداکثر 30 کاراکتر (ترکیبی از حروف و اعداد باشد)',
              'type' => 'password',
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'password_confirmation',
              'label' => 'رمز عبوری که در بالا وارد کرده اید را دوباره اینجا بنویسید',
              'type' => 'password',
            ])
            @endcomponent

            @component('components.form.button', [
              'label' => 'تکمیل فرم',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'برگشت',
              'flat' => true,
              'href'  =>  route('login'),
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
