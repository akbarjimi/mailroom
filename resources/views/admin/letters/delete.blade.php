@extends('admin.layout')
@section('content')
    @component('components.sheet',[
      'header' => "حذف",
      'padding' => true,
      'medium' => true,
      'backlink'=> route('letters.index'),
    ])
        @component('components.form', [
        'action' => route('letters.destroy', $letter),
        'method' => 'DELETE',
      ])
            @component('components.form.label', [
              'key' => "آیا از حذف کد {$letter->lettertype->code} : {$letter->project->name}  مطمئن هستید؟ ",
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
              'href'  =>  route('letters.index', $letter),
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
