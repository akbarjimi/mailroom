@extends('profile.layout')
@section('title','درون ریزی')
@section('content')
    @component('components.sheet', [
      'header'    =>  'بارگذاری فایل درون ریزی ',
      'padding'   =>  true,
      'backlink' => route('profile.schools.imports.index', $school)
    ])
        @component('components.chip',[
            'class' => 'info',
            'label' => 'فایل نمونه دانش آموزان',
            'href'  =>  request()->fullUrlWithQuery(['sample' => 'students']),
        ])
        @endcomponent
        @component('components.chip',[
            'class' => 'info',
            'label' => 'فایل نمونه کارکنان',
            'href'  =>  request()->fullUrlWithQuery(['sample' => 'staffs']),
        ])
        @endcomponent
        @component('components.chip', [
          'label' => 'راهنمای کدهای موردنیاز',
          'icon' => 'help',
          'icon_href' => 'ggg',
          'target' => 'help_modal',
          'class' => "modal-trigger pointer"
        ])
        @endcomponent
        @component('components.modal', [
            'id' => 'help_modal',
            'buttons' => [
                ['class' => 'modal-action modal-close', 'label' => 'بستن']
            ],
            ])
            <strong>انواع کدهای مقاطع تحصیلی</strong><br>
            @foreach(School::grades() as $id => $name)
                {{ $id }} : {{ $name }}<br>
            @endforeach
            <strong>انواع کدهای بیمه</strong><br>
            @foreach(Insured::payments()->except(Insured::PERSONAL) as $id => $name)
                {{ $id }} : {{ $name }}<br>
            @endforeach
            <strong>کدهای اصلی/تبعی</strong><br>
            @foreach(Insured::mainOrSub() as $id => $name)
                {{ $id }} : {{ $name }}<br>
            @endforeach
        @endcomponent
        @component('components.form', [
          'action'    =>  route('profile.schools.imports.store', $school),
          'method'    =>  'POST',
          'enctype'   =>  true,
        ])

            @component('components.form.select',[
            'name'        =>  'insured',
            'label'       =>  'بیمه شوندگان',
            'options' => [
                'students' => 'دانش آموزان',
                'staffs' => 'کارکنان',
            ],
            "select_item" =>  old("insured")
            ])
            @endcomponent

            @component('components.form.text',[
              'name' => 'description',
              'label' => 'توضیحات',
              'value' => old('description')
            ])
            @endcomponent

            @component('components.form.file', [
              'name' => 'import',
              'label' => 'اکسل اطلاعات'
            ])
            @endcomponent

            @component('components.form.checkbox',[
                'name' => 'confirm',
                'label' => 'پذیرش مسئولیت'
            ])
            @endcomponent

            <ul class="notices">
                @if($errors->first('rows') )
                    <li class="red-text">{{ $errors->first('rows') }}</li>
                @endif
                @if($errors->first('confirm') )
                    <li class="red-text">{{ $errors->first('confirm') }}</li>
                @endif
                    <li>
                        <strong>
                            برای دانش آموزان اتباع، به جای کد ملی، کد ۱۱ رقمی سناد (کد اتباع) آنها را وارد کنید.
                        </strong>
                    </li>
                    <li>
                        <strong>
                            دانش آموزان کمیساریا (پناهنده) الزامی به داشتن کد ملی و نام پدر ندارند.
                        </strong>
                    </li>
                    <li>
                        <strong>
                            فایل اطلاعات دانش آموزان/کارکنان بایستی به صورت اکسل ۲۰۰۳ یا ۲۰۰۷ بارگذاری شود
                        </strong>
                    </li>
                    <li>
                        <strong>
                            سطر اول فایل پردازش نمی شود و فقط به عنوان کلید استفاده می شود
                        </strong>
                    </li>
            </ul>
            <br>
            @component('components.chip', [
              'label' => 'درون‌ریزی',
              'class' => "modal-trigger pointer",
              'active' => true,
             'target' => 'confirmation_modal',
            ])
            @endcomponent
            @component('components.modal', ['id' => 'confirmation_modal', 'header' => 'اخطار',
              'buttons' => [
                ['label' => 'درون‌ریزی', 'type' => 'submit', 'class' => 'upload'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
                @component('components.form.label', [
                    'key' => 'اخطار',
                    'value' => 'در صورت درون ریزی مجدد کارکنان یا دانش آموزان، اطلاعات کارکنان یا دانش آموزان در سال تحصیلی جاری، پاک خواهد شد.',
                ])
                @endcomponent
            @endcomponent
            @component('components.form.button', [
              'label'  =>  'انصراف',
              'flat'  =>  TRUE,
              'href'  =>  route('profile.schools.index')
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
