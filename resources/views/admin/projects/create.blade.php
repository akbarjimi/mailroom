@extends('admin.layout')
@section('title','ایجاد پروژه')
@section('content')
    @component('components.sheet', [
      'header' => 'ایجاد پروژه',
      'padding' => true,
      'medium' => true,
      'backlink'  =>  route("projects.index"),
    ])
        @component('components.form', [
          'action'    => route('projects.store'),
          'method'    => 'POST',
        ])
            @component('components.form.text',[
              'name'  => 'name',
              'label' => 'نام',
              'value' => old('name'),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'code',
              'label' => 'کد',
              'value' => old('code'),
            ])
            @endcomponent

            @component('components.form.button', [
              'label' => 'ذخیره',
              'type'  => 'submit',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'انصراف',
              "href"  =>  route("projects.index"),
              "flat"  =>  true,
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
