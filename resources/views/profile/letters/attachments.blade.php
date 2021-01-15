@extends($admin ? 'admin.layout' : 'profile.layout')
@section('title','معرفی نامه ' . $letter->form->title)
@section('content')
    @component('components.sheet',[
      'header' => 'افزودن '.$letter->form->attachments[$letter->nextAttachment()],
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'action' => route('letters.attachments.store', $letter),
          'method' => 'post',
          'enctype' => true,
        ])
            @component('components.form.file', [
              'name' => 'attachment',
              'label' => 'انتخاب فایل',
            ])
            @endcomponent        
            
            <br>
            @component('components.form.button',[
              'label' => 'بارگذاری '.$letter->form->attachments[$letter->nextAttachment()],
            ])
            @endcomponent

            @component('components.form.button',[
              'href' => $back,
              'label' => 'انصراف',
              'flat' => true
            ])
            @endcomponent

        @endcomponent
    @endcomponent
@endsection
