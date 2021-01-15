@extends('portal.layout')
@section('topbar')
  @component('components.sheet', [
    'header'    => 'رمز عبور جدید',
    'padding'   => TRUE,
    'medium'    => TRUE,
    'backlink'  =>  route('register'),
  ])
    @component('components.form', ['action' => '/password', 'method' => 'POST'])
      @component('components.form.text', [
        'name' => 'password',
        'type'  => 'password',
        'label' => 'رمز عبور جدید',
      ])
      @endcomponent
      @component('components.form.text', [
        'name' => 'password-confirm',
        'type'  => 'password',
        'label' => 'تایید رمز عبور جدید',
      ])
      @endcomponent
      @component('components.form.button', [
        'label' => 'ثبت نام نهایی',
      ])
      @endcomponent
    @endcomponent
  @endcomponent
@endsection
