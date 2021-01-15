@extends('admin.layout')
@section('title','ایجاد نامه')
@section('content')
    @component('components.sheet', [
      'header' => 'ایجاد نامه',
      'padding' => true,
      'medium' => true,
      'backlink'  =>  route("letters.index"),
    ])
        @component('components.form', [
          'action'    => route('letters.update', $letter->id),
          'method'    => 'PATCH',
        ])
            @component('components.form.select',[
              'name'  => 'lettertype',
              'label' => 'نوع نامه',
              'value' => old('lettertype', $letter->lettertype_id),
              'options' => $lettertypes,
            ])
            @endcomponent

            @component('components.form.select',[
              'name'  => 'project',
              'label' => 'پروژه',
              'value' => old('project',$letter->project_id),
              'options' => $projects,
            ])
            @endcomponent

            @component('components.form.date',[
              'name'  => 'date',
              'label' => 'تاریخ',
              'value' => old('date',$letter->date),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'title',
              'label' => 'موضوع',
              'value' => old('title',$letter->title),
            ])
            @endcomponent

            @component('components.form.select',[
              'name'  => 'user',
              'label' => 'تهیه کننده',
              'value' => old('user',$letter->user_id),
              'options' => $users,
            ])
            @endcomponent

            @component('components.form.button', [
              'label' => 'ذخیره',
              'type'  => 'submit',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'انصراف',
              "href"  =>  route("letters.index"),
              "flat"  =>  true,
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
