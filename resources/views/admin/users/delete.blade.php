@extends('admin.layout')
@section('content')
    @component('components.sheet',[
      'header' => "حذف",
      'padding' => true,
      'medium' => true,
      'backlink'=> route('users.index'),
    ])
        @component('components.form', [
        'method' => 'delete',
        'action' => route('users.destroy', $user)
      ])
            @component('components.form.label', [
              'key' => "آیا از حذف این کاربر مطمئن هستید؟ ",
              'value' => $user->fullname,
            ])
            @endcomponent
            <br>
            @component('components.form.button', [
              'name' => 'delete',
              'label' => 'حذف',
              'type' => 'submit',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'انصراف',
              'flat'  => TRUE,
              'href'  =>  route('users.index', $user),
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
