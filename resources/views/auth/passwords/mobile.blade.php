@extends('portal.layout')
@section('topbar')
    @component('components.sheet', [
      'header'    => 'ورود شماره تلفن همراه',
      'padding'   => TRUE,
      'medium'    => TRUE,
      'backlink'  =>  route('login'),
    ])
        @component('components.form', ['action' => '/reset', 'method' => 'POST'])
            @component('components.form.text', [
              'name' => 'mobile',
              'label' => 'تلفن همراه',
              'value' => old('mobile')
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'دریاف رمز عبور یکبار مصرف',
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
