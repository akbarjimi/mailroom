@extends('profile.layout')
@section('title',$use_as_form_six ? 'فرم شماره ۶' : 'فرم شماره ۵')
@section('content')
    @component('components.sheet',[
      'header' => $use_as_form_six ? 'فرم شماره ۶' : 'فرم شماره ۵',
      'backlink' => route('profile.schools.insureds.forms.index', [$school, $insured]),
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'method' => 'POST',
          'action' => route('profile.schools.insureds.forms.print', [$school, $insured, $letter])
        ])
            @include('profile.insureds.forms.form_five_template')
              @component('components.form.button',[
                'label' => 'چاپ',
              ])
              @endcomponent
              @component('components.form.button',[
                'label' => 'انصراف',
                'href' => route('profile.schools.insureds.forms.index', [$school, $insured]),
                'flat' => true
              ])
              @endcomponent
        @endcomponent
    @endcomponent
@endsection
