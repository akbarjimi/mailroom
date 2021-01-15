@extends('portal.layout')
@section('topbar')
    @component('components.sheet', [
      'header'    => 'ثبت نام کاربران مهمان',
      'padding'   => TRUE,
      'medium'    => TRUE,
      'backlink'  =>  route('login'),
    ])
        @component('components.form', ['action' => route('register'), 'method' => 'POST'])
            @component('components.form.text', [
              'name' => 'code',
              'label' => 'کد پرسنلی یا شماره دفتر کل',
              'value' => old('code')
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'national_id',
              'label' => 'کد ملی',
              'value' => old('national_id')
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'name',
              'label' => 'نام',
              'value' => old('name')
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'family',
              'label' => 'نام خانوادگی',
              'value' => old('family')
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'mobile',
              'label' => 'موبایل',
              'value' => old('mobile')
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'password',
              'label' => 'رمز عبور',
              'type' => 'password',
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'password_confirmation',
              'label' => 'تکرار رمز عبور',
              'type' => 'password',
            ])
            @endcomponent
            <p class="title">
                اگر از فرهنگیان شهرستان های استان تهران هستید با کد پرسنلی خود از فرم ورود استفاده کنید.
            </p>

            @component('components.form.button', [
              'label' => 'ثبت نام کاربر مهمان',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'ورود',
              'flat' => true,
              'href'  =>  route('login'),
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
