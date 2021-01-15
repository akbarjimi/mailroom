@extends('portal.layout')
@section('topbar')
  @component('components.sheet', [
    'header'    => 'تایید شماره تلفن',
    'padding'   => TRUE,
    'medium'    => TRUE,
    'backlink'  =>  route('login'),
  ])
    @component('components.form', [
        'action' => route('post_verify'),
        'method' => 'POST'
     ])
      @component('components.form.text', [
        'name' => 'verificationCode',
        'label' => 'کد دریافت',
        'value' => old('verfication')
      ])
      @endcomponent

      @if(isset($user))
          @component('components.form.text', [
            'name' => 'password',
            'label' => 'رمز عبوری برای خود انتخاب کنید',
            'value' => old('password'),
            'type'  => 'password',
          ])
          @endcomponent

          @component('components.form.text', [
            'name' => 'password_confirmation',
            'label' => 'رمز عبور انتخاب شده را دوباره وارد کنید',
            'value' => old('password_confirmation'),
            'type'  => 'password',
          ])
          @endcomponent
      @endif

      @component('components.form.button', [
        'label' => 'تایید',
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
