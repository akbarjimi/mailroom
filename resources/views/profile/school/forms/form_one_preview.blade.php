@extends('profile.layout')
@section('title','صورتجلسه')
@section('content')
    @component('components.sheet',[
      'header' => 'صورتجلسه',
      'backlink' => route('profile.schools.insureds.index', $school),
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'method' => 'POST',
          'action' => route('profile.schools.forms.store', $school)
        ])
            @include('profile.school.forms.form_one_template')
            @component('components.form.button',[
              'label' => 'ثبت درخواست',
            ])
            @endcomponent
            @component('components.form.button',[
              'label' => 'انصراف',
              'href' => route('profile.schools.forms.index', $school),
              'flat' => true
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
