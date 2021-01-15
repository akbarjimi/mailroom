@extends('profile.layout')
@section('title','معرفی نامه ' . $form->title)
@section('content')
  @component('components.sheet',[
    'header' => 'معرفی نامه ' . $form->title,
    'backlink' => isset($employee)? route('admin.users.forms.index', $employee): route('profile.forms.index'),
    'medium' => true,
    'padding' => true
  ])
    {!! html_entity_decode($form->description) !!}
    <br>
    <br>
    @component('components.form', ['action' => route('profile.forms.form', $form)])
      @foreach ($form->fields as $field)
          @if ($field['type'] == 'multi')
              @component('components.form.select', [
                'label' => 'تعداد '. $field['label'],
                'name' => $field['name'].'_count',
                'options' => [0, 1, 2, 3, 4, 5, 6, 7]
              ])
                  
              @endcomponent
          @endif
      @endforeach
      @component('components.form.button',[
        'href' => isset($employee)? route('admin.users.forms.form', [$employee, $form]): route('profile.forms.form', $form),
        'label' => 'درخواست فرم'
      ])
      @endcomponent

      @component('components.form.button',[
        'label' => 'انصراف',
        'href' => isset($employee)? route('admin.users.forms.index', $employee): route('profile.forms.index'),
        'flat' => true
      ])
      @endcomponent
    @endcomponent
  @endcomponent
@endsection
