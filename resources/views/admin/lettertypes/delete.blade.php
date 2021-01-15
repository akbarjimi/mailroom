@extends('admin.layout')
@section('content')
    @component('components.sheet',[
      'header' => "حذف",
      'padding' => true,
      'medium' => true,
      'backlink'=> route('lettertypes.index'),
    ])
        @component('components.form', [
        'method' => 'delete',
        'action' => route('lettertypes.destroy', $lettertype)
      ])
            @component('components.form.label', [
              'key' => "آیا از حذف کد {$lettertype->code} : {$lettertype->name}  مطمئن هستید؟ ",
              'value' => "",
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
              'href'  =>  route('lettertypes.index', $lettertype),
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
