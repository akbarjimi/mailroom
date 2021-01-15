@extends('profile.layout')
@section('title','صورتجلسه های من')
@section('content')
    @component('components.sheet',[
        'header'    =>  " آموزشگاه $school->name",
        'padding'   =>  true,
        'medium' => true,
        'backlink'  =>  route("profile.schools.forms.index", $school),
    ])
        <div>
            {!! $letter->body !!}
        </div>
        <br/>
        @component('components.chip', [
          'label' => 'چاپ',
          'class' => "modal-trigger pointer",
          'active' => true,
          'target' => 'confirmation_modal',
        ])
        @endcomponent
        @component('components.modal', ['id' => 'confirmation_modal', 'header' => 'نکته',
          'buttons' => [
            ['label' => 'چاپ', 'href' => route('profile.schools.forms.print', [$school, $letter]), 'target' => '_blank',],
            ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
          ]
        ])
            @component('components.form.label', [
                'key' => 'توجه',
                'value' => 'از این صورتجلسه دو نسخه تهیه کنید، سپس به دایره رفاه منطقه خود مراجعه فرمایید.',
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
