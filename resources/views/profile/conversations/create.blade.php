@extends('profile.layout')
@section('content')
  @component('components.sheet', [
    'header'    => 'درخواست جدید',
    'padding'   => TRUE,
    'medium'   => TRUE,
    'backlink'  =>  route('profile.conversations.index'),
  ])
    @component('components.form', ['action' => route('profile.conversations.store'), 'method' => 'POST', 'enctype' => true])

      @component('components.form.text', [
        'name' => 'title',
        'label' => 'عنوان درخواست',
        'value' => old('title')
      ])
      @endcomponent

      @component('components.form.select', [
        'name' => 'region_id',
        'label' => 'پاسخگو',
        'options' => $regions,
        'select_item' => old('region_id'),
      ])
      @endcomponent

      @component('components.form.select', [
        'name' => 'type',
        'label' => 'نوع درخواست',
        'options' => $types,
        'select_item' => old('type'),
      ])
      @endcomponent

      @component('components.form.textarea', [
        'name'        => 'body',
        'value'       => old('body'),
        'class_name'  =>  '',
        'label'       =>  'متن پیام'
      ])
      @endcomponent

      @component('components.form.file', [
           'name'   => 'comment_attachment',
           'label'  => 'فایل ضمیمه',
         ])
      @endcomponent

      @component('components.form.button', [
        'label' => 'ارسال',
      ])
      @endcomponent

      @component('components.form.button', [
        'label' => 'انصراف',
        'flat' => true,
        'href'  =>  route('profile.conversations.index'),
      ])
      @endcomponent

    @endcomponent
  @endcomponent
@endsection
