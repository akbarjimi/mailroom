@extends('admin.layout')
@section('content')
    @component('components.sheet',[
      'header' => "حذف",
      'padding' => true,
      'medium' => true,
      'backlink'=> route('projects.index'),
    ])
        @component('components.form', [
        'method' => 'delete',
        'action' => route('projects.destroy', $project)
      ])
            @component('components.form.label', [
              'key' => "آیا از حذف کد {$project->code} : {$project->name}  مطمئن هستید؟ ",
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
              'href'  =>  route('projects.index', $project),
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
