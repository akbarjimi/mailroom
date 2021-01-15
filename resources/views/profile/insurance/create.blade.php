@extends('profile.layout')
@section('title', 'افزودن فرم معرفی به بیمه')
@section('content')
    @component('components.sheet', [
      'header' => 'افزودن فرم معرفی به بیمه',
      'padding' => true,
      'medium'    => true,
      'backlink'=> route('profile.school.index'),
    ])
        @component('components.form', [
          'action' => route('profile.insurance.store', $student),
          'method' => 'POST',
        ])

            @component('components.form.text', [
              'disabled' => true,
              'value' => $student->fullname
            ])
            @endcomponent
            @component('components.form.text', [
              'disabled' => true,
              'value' => $student->code
            ])
            @endcomponent

            @component('components.form.textarea', [
              'name' => 'body',
              'label' => 'متن معرفی نامه',
              'value' => old('body')
            ])
            @endcomponent

            @component('components.form.button', ['label' => 'ذخیره'])@endcomponent

            @component('components.form.button', [
              'label'  =>  'انصراف',
              'flat'  =>  true,
              'href'  =>  route('profile.school.index'),
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection