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
          'action'    => route('letters.store'),
          'method'    => 'POST',
        ])
            @component('components.form.select',[
              'name'  => 'lettertype',
              'label' => 'نوع نامه',
              'value' => old('lettertype'),
              'options' => $lettertypes,
            ])
            @endcomponent

            @component('components.form.select',[
              'name'  => 'project',
              'label' => 'پروژه',
              'value' => old('project'),
              'options' => $projects,
            ])
            @endcomponent

            @component('components.form.date',[
              'name'  => 'date',
              'label' => 'تاریخ',
              'value' => old('date'),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'title',
              'label' => 'موضوع',
              'value' => old('title'),
            ])
            @endcomponent

            @component('components.form.select',[
              'name'  => 'user',
              'label' => 'تهیه کننده',
              'value' => old('user'),
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
