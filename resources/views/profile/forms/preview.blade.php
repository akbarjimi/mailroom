@extends('profile.layout')
@section('title','معرفی نامه ' . $form->title)
@section('content')
  @component('components.sheet',[
    'header' => 'معرفی نامه ' . $form->title,
    'backlink' => route('profile.forms.index'),
    'medium' => true,
    'padding' => true
  ])
    {!! html_entity_decode( $form->generateLetter() ) !!}

    <br>
    <br>

    @component('components.form.button',[
      'href' => isset($employee)?
          route('admin.users.forms.store', array_merge(['user' => $employee, 'form' => $form], request()->all() )):
          route('profile.forms.store', array_merge(['form' => $form], request()->all() )),
      'label' => 'ثبت درخواست'
    ])
    @endcomponent

    @if (count($form->requiredFields()))
      @component('components.form.button',[
        'label' => 'ویرایش اطلاعات',
        'href' => isset($employee)?
            route('admin.users.forms.form', array_merge( ['user' => $employee, 'form' => $form], request()->all() ) ):
            route('profile.forms.form', array_merge( ['form' => $form], request()->all() ) ),
        'flat' => true
      ])
      @endcomponent
    @endif

    @component('components.form.button',[
      'label' => 'انصراف',
      'href' => isset($employee)? route('admin.users.forms.index', $employee): route('profile.forms.index'),
      'flat' => true
    ])
    @endcomponent

  @endcomponent
@endsection
