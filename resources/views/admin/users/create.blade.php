@extends('admin.layout')
@section('title','ایجاد کاربر')
@section('content')
    @component('components.sheet', [
      'header' => 'ایجاد کاربر',
      'padding' => true,
      'medium' => true,
      'backlink'  =>  route("users.index"),
    ])
        @component('components.form', [
          'action'    => route('users.store'),
          'method'    => 'POST',
        ])
            @component('components.form.text',[
              'name'  => 'name',
              'label' => 'نام',
              'value' => old('name'),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'family',
              'label' => 'نام خانوادگی',
              'value' => old('family'),
            ])
            @endcomponent

            @component('components.form.button', [
              'label' => 'ذخیره',
              'type'  => 'submit',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'انصراف',
              "href"  =>  route("users.index"),
              "flat"  =>  true,
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
