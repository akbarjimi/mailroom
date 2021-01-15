@extends('admin.layout')
@section('title','بروزرسانی نوع نامه')
@section('content')
    @component('components.sheet', [
      'header' => 'بروزرسانی نوع نامه',
      'padding' => true,
      'medium' => true,
      'backlink'  =>  route("lettertypes.index"),
    ])
        @component('components.form', [
          'action'    => route('lettertypes.update', $lettertype),
          'method'    => 'PATCH',
        ])
            @component('components.form.text',[
              'name'  => 'lettertype_name',
              'label' => 'نام',
              'value' => old('lettertype_name', $lettertype->name),
            ])
            @endcomponent

            @component('components.form.text',[
              'name'  => 'lettertype_code',
              'label' => 'کد',
              'value' => old('lettertype_code', $lettertype->code),
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
