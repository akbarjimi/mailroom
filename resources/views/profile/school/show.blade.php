@extends('profile.layout')
@section('title', 'آموزشگاه ' . $school->name)
@section('content')
    @component('components.sheet',[
      'header'    =>  'آموزشگاه ' . $school->name,
      'padding'   =>  true,
      'medium' => true,
      'backlink'  =>  route("profile.schools.index"),
      'tabs'      =>  [
          ['title' => 'نمایش', ],
          ['title' =>  'بیمه شدگان', 'link'  =>  route("profile.schools.insureds.index", $school) ],
          ['title' => 'گزارش‌ها', 'link' => route('profile.schools.forms.index', $school)],
          ['title' => 'درون ریزی', 'link' => route('profile.schools.imports.index', $school)],
      ]
    ])

        @component('components.show',[
          'items' => [
            ['label' => 'کد آموزشگاه',        'value' => $school->school_code ],
            ['label' => 'نام آموزشگاه',        'value' => $school->name ],
            ['label' => 'مدیریت',        'value' => $school->user->fullname ],
            ['label' => 'ظرفیت',        'value' => "{$school->capacity} نفر" ],
            ['label' => 'تعداد دانش آموزان سال تحصیلی جاری',        'value' => "{$school->students->count()} نفر" ],
            ['label' => 'تعداد کارکنان و خانواده سال تحصیلی جاری',        'value' => "{$school->staffs->count()} نفر" ],
            ['label' => 'تعداد دانش آموزان صورتجلسه سال تحصیلی جاری',        'value' => "{$school->students->where('status','=',Insured::BILLED)->count()} نفر" ],
            ['label' => 'تعداد کارکنان و خانواده صورتجلسه سال تحصیلی جاری',        'value' => "{$school->staffs->where('status','=',Insured::BILLED)->count()} نفر" ],
            ['label' => 'منطقه',        'value' => $school->region->name ],
            ['label' => 'ایجاد شده در',   'value' => jdate($school->created_at)->format( statics()->date->format['long'] )],
            ['label' => 'ویرایش شده در',  'value' => jdate($school->updated_at)->format( statics()->date->format['long'] )]
          ]
        ])
        @endcomponent

    @endcomponent
@endsection
