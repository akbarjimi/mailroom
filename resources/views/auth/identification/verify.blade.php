@extends('admin.layout')
@section('title','تایید شماره تلفن ')
@section('content')
  @component('components.sheet', [
    'header'    => 'تایید شماره تلفن',
    'padding'   => TRUE,
    'medium'    => TRUE,
    'backlink'  =>  route('login'),
  ])
    @component('components.form', [
        'action' => route('identity.final', $user),
        'method' => 'POST'
     ])
      @component('components.form.text', [
        'name' => 'verificationCode',
        'label' => 'کد دریافتی',
        'value' => old('verificationCode')
      ])
      @endcomponent
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
