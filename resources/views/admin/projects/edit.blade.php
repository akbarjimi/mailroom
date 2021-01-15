@extends('admin.layout')
@section('title','بروزرسانی پروژه')
@section('content')
    @component('components.sheet', [
      'header' => 'بروزرسانی پروژه',
      'padding' => true,
      'medium' => true,
      'backlink'  =>  route("projects.index"),
    ])
        @component('components.form', [
          'action'    => route('projects.update', $project),
          'method'    => 'PATCH',
        ])
            @component('components.form.text',[
              'name'  => 'name',
              'label' => 'نام',
              'value' => old('name', $project->name),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'code',
              'label' => 'کد',
              'value' => old('code',$project->code),
            ])
            @endcomponent

            @component('components.form.button', [
              'label' => 'ذخیره',
              'type'  => 'submit',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'انصراف',
              "href"  =>  route("projects.index"),
              "flat"  =>  true,
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
