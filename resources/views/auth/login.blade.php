@extends('portal.layout')
@section('title','ورود')
@section('topbar')
  @component('components.sheet', [
    'header'    => 'ورود',
    'padding'   => TRUE,
    'medium'    => TRUE,
  ])
    @component('components.form', ['action' => route('login'), 'method' => 'POST'])
        @if(!isset($username))
          @component('components.form.text', [
            'name' => 'mobile',
            'label' => 'کد پرسنلی یا تلفن همراه',
            'value' => old('mobile'),
            'autofocus' =>  true,
          ])
          @endcomponent
        @else
            @component('components.form.text', [
              'name' => 'mobile',
              'value' => $username,
              'hidden'    => true,
            ])
            @endcomponent
        @endif
      @if(isset($password) && $password)
          @component('components.form.text', [
            'name' => 'password',
            'label' => 'رمز عبور',
            'type'  => 'password',
            'autofocus' =>  true,
          ])
          @endcomponent
      @endif
      @component('components.form.button', [
        'label' => 'ورود',
      ])
      @endcomponent
      @component('components.form.button', [
        'label' => 'فراموشی رمز عبور',
        'flat' => true,
        'href'  =>  route('password_reset'),
      ])
      @endcomponent
      @if($errors->first('mobile'))
      <p class="title">
          <br>
          اگر از فرهنگیان شهرستان های استان تهران نیستید می توانید 
          <a href="{{ route('register') }}">ثبت نام</a> کنید.
          در غیر این صورت با تلفن 0215504102 تماس حاصل فرمایید.
        </p>
      @endif
      {{-- @component('components.form.button', [
        'label' => 'ثبت نام کاربران مهمان',
        'flat' => true,
        'href'  =>  route('register'),
      ])
      @endcomponent --}}
    @endcomponent
  @endcomponent
@endsection
