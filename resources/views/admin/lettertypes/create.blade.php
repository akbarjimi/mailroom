@extends('admin.layout')
@section('title','ایجاد نوع جدید نامه')
@section('content')
    @component('components.sheet', [
      'header' => 'ایجاد نوع جدید نامه',
      'padding' => true,
      'medium' => true,
      'backlink'  =>  route("lettertypes.index"),
    ])
        @component('components.form', [
          'action'    => route('lettertypes.store'),
          'method'    => 'POST',
        ])
            @component('components.form.text',[
              'name'  => 'lettertype_name',
              'label' => 'نام',
              'value' => old('lettertype_name'),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'lettertype_code',
              'label' => 'کد',
              'value' => old('lettertype_code'),
            ])
            @endcomponent

            @component('components.form.button', [
              'label' => 'ذخیره',
              'type'  => 'submit',
            ])
            @endcomponent
            @component('components.form.button', [
              'label' => 'انصراف',
              "href"  =>  route("lettertypes.index"),
              "flat"  =>  true,
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
