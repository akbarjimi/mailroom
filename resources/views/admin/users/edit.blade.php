@extends('admin.layout')
@section('title','بروزرسانی کاربر')
@section('content')
    @component('components.sheet', [
      'header' => 'بروزرسانی کاربر',
      'padding' => true,
      'medium' => true,
      'backlink'  =>  route("users.index"),
    ])
        @component('components.form', [
          'action'    => route('users.update', $user),
          'method'    => 'PATCH',
        ])
            @component('components.form.text',[
              'name'  => 'name',
              'label' => 'نام',
              'value' => old('name', $user->name),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'family',
              'label' => 'نام خانوادگی',
              'value' => old('code',$user->family),
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
