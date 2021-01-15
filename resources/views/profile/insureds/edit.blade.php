@extends('profile.layout')
@section('title', 'ویرایش بیمه شده ' . $insured->fullname)
@section('content')

    @component('components.sheet',[
      'header'    =>  'ویرایش بیمه شده ' . $insured->fullname,
      'padding'     =>  true,
      'medium'      =>  true,
      'backlink'    =>  route('profile.schools.insureds.show', [$school, $insured]),
      'tabs'      =>  [
          ['title' => 'نمایش', 'link'  =>  route("profile.schools.insureds.show", [$school, $insured]) ],
          ['title' =>  'ویرایش'],
          ['title' => 'فرم‌ها', 'link' => route('profile.schools.insureds.forms.index', [$school, $insured])],
      ]
    ])
        @component('components.form', ['action' => route('profile.schools.insureds.update', [$school, $insured]), 'method' => 'PUT'])
            <div class="">
                @component('components.form.text', [
                'name' => 'name',
                'label' => 'نام',
                'value' => old('name', $insured->name)
                ])
                @endcomponent
                @component('components.form.text', [
                'name' => 'family',
                'label' => 'نام خانوادگی',
                'value' => old('family', $insured->family)
                ])
                @endcomponent
                @component('components.form.text', [
                'name' => 'father',
                'label' => 'نام پدر',
                'value' => old('father',  $insured->father)
                ])
                @endcomponent
                @unless($insured->insurance_type === Insured::REFUGEES)
                    @component('components.form.text', [
                      'name' => 'national_id',
                      'label' => 'کد ملی',
                      'value' => old('national_id',  $insured->national_id),
                    ])
                    @endcomponent
                @endunless
                @if(in_array($insured->insurance_type, [Insured::STAFFS_EVENTS, Insured::STAFFS_FAMILY_EVENTS]))
                    @component('components.form.text', [
                    'name' => 'user_code',
                    'label' => 'کد بیمه شده',
                    'value' => old('user_code',  $insured->user_code)
                    ])
                    @endcomponent
                @endif
                @component('components.form.text', [
                'name' => 'academic_year',
                'label' => 'سال تحصیلی',
                'value' => old('academic_year',  $insured->academic_year)
                ])
                @endcomponent
                @component('components.form.select', [
                'name' => 'grade',
                'label' => 'پایه تحصیلی',
                'select_item' => old('grade', $insured->grade),
                'options' => School::grades()->toArray(),
                ])
                @endcomponent
                @component('components.form.button', [
                'label' => 'ذخیره',
                ])
                @endcomponent
                @component('components.form.button', [
                'label'  =>  'انصراف',
                'flat'  =>  TRUE,
                'href'  =>  route('profile.schools.index'),
                ])
                @endcomponent
            </div>
            @if($errors->first('errors'))
                {{ $errors->first('errors') }}
            @endif
        @endcomponent
    @endcomponent
@endsection
