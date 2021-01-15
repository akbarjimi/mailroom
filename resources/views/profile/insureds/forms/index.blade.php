@extends('profile.layout')
@section('title', "فرم‌های بیمه شده ".$insured->fullname)
@section('content')
    @component('components.sheet',[
      'header' =>  "فرم‌های بیمه شده ".$insured->fullname,
      'backlink'  =>  route("profile.schools.insureds.show", [$school, $insured]),
      'padding' => true,
      'medium' => true,
      'tabs'      =>  [
          ['title' => 'نمایش', 'link'  =>  route("profile.schools.insureds.show", [$school, $insured]) ],
          ['title' => 'ویرایش', 'link'  =>  route("profile.schools.insureds.edit", [$school, $insured]) ],
          ['title' => 'فرم‌ها',],
      ]
      ])
        <div class="padding-half">
            <i class="material-icons">add</i>
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'فرم شماره ۵',
                'href'  =>  route('profile.schools.insureds.forms.create', [$school, $insured, 'type' => Letter::FORM_FIVE])
            ])
            @endcomponent
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'فرم شماره ۶',
                'href'  =>  route('profile.schools.insureds.forms.create', [$school, $insured, 'type' => Letter::FORM_SIX])
            ])
            @endcomponent
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'بیماران پر هزینه',
                'href'  =>  route('profile.schools.insureds.forms.create', [$school, $insured, 'type' => Letter::FORM_SEVEN])
            ])
            @endcomponent
        </div>
        <table>
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نوع</th>
                <th>عنوان</th>
                <th>تاریخ ایجاد</th>
            </tr>
            </thead>
            <tbody>
            @forelse($letters as $letter)
                @component('components.tr',[
                    'columns' => [
                    $loop->iteration,
                    Letter::types()->get($letter->type),
                    $letter->data['body'] ?? '',
                    jdate($letter->created_at)->format("d F Y H:i:s")
                  ],
                    'href'    =>  route('profile.schools.insureds.forms.show', [$school, $insured, $letter]),
                    ])
                @endcomponent
            @empty
                <td colspan="10" class="center-align">
                    اطلاعات بیمه شدگان موجود نیست
                </td>
            @endforelse
            </tbody>
        </table>
    @endcomponent
@endsection
