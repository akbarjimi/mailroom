@extends('profile.layout')
@section('title','بیماران خاص و پرهزینه')
@section('content')
    @component('components.sheet',[
      'header' => 'بیماران خاص و پرهزینه',
      'backlink' => route('profile.schools.insureds.forms.index', [$school, $insured]),
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'method' => 'POST',
          'action' => route('profile.schools.insureds.forms.print', [$school, $insured, $letter])
        ])
            @include('profile.insureds.forms.form_seven_template')
            @component('components.form.button',[
              'label' => 'چاپ',
            ])
            @endcomponent
            @component('components.form.button',[
              'label' => 'انصراف',
              'href' => route('profile.schools.insureds.forms.index', [$school , $insured]),
              'flat' => true
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
