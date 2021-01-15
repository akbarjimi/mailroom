@extends('profile.layout')
@section('title', 'بیمه شده ' . $insured->fullname)
@section('content')
    @component('components.sheet',[
      'header'    =>  'بیمه شده ' . $insured->fullname,
      'padding'   =>  true,
      'medium' => true,
      'backlink'  =>  route("profile.schools.insureds.index", $school),
      'tabs'      =>  [
          ['title' => 'نمایش', ],
          ['title' => 'ویرایش', 'link' => route('profile.schools.insureds.edit', [$school, $insured])],
          ['title' => 'فرم‌ها', 'link' => route('profile.schools.insureds.forms.index', [$school, $insured])],
      ]
    ])

        @component('components.show',[
          'items' => [
            ['label' => 'کد پرسنلی بیمه شده',        'value' => $insured->user_code ],
            ['label' => 'نام بیمه شده',        'value' => $insured->name ],
            ['label' => 'نام خانوادگی بیمه شده',        'value' => $insured->family ],
            ['label' => 'نام پدر',        'value' => $insured->father ],
            ['label' => 'کد ملی',        'value' => $insured->national_id ],
            ['label' => 'وضعیت بیمه سال جاری',        'value' => Insured::statuses()->get($insured->status)],
            ['label' => 'کد آموزشگاه',        'value' => $school->school_code ],
            ['label' => 'سال تحصیلی',        'value' => $insured->academic_year ],
            ['label' => 'پایه تحصیلی',        'value' => School::grades()->get($insured->grade) ],
            ['label' => 'نوع پرداخت بیمه',        'value' => Insured::payments()->get($insured->payment_type) ],
            ['label' => 'ایجاد شده در',   'value' => jdate($insured->created_at)->format( statics()->date->format['long'] )],
            ['label' => 'ویرایش شده در',  'value' => jdate($insured->updated_at)->format( statics()->date->format['long'] )]
          ]
        ])
        @endcomponent
    @endcomponent
@endsection
