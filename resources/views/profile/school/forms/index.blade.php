@extends('profile.layout')
@section('title','گزارش‌‌ها')
@section('content')
    @component('components.sheet',[
        'header'    =>  'آموزشگاه ' . $school->name,
        'medium' => true,
        'backlink'  =>  route("profile.schools.index"),
        'tabs'      =>  [
            ['title' => 'نمایش','link'  =>  route("profile.schools.show", $school)],
            ['title' =>  'بیمه شدگان', 'link'  =>  route("profile.schools.insureds.index", $school) ],
            ['title' => 'گزارش‌‌ها'],
            ['title' => 'درون ریزی', 'link' => route('profile.schools.imports.index', $school)],
        ]
    ])
        <div class="padding-half">
            @if($school->formOneIsNotMade())
                @component('components.chip', [
                  'label' => 'تولید صورتجلسه سال جاری',
                  'icon' => 'assignment',
                  'icon_href' => 'ggg',
                  'target' => 'description_modal',
                  'class' => "modal-trigger pointer"
                ])
                @endcomponent
            @endif

            @component('components.chip', [
              'label' => 'انواع فرم',
              'icon' => 'filter_list',
              'icon_href' => 'ggg',
              'target' => 'form_types_modal',
              'active' => request()->filled('types'),
              'class' => "modal-trigger pointer"
            ])
            @endcomponent


            @if(!empty(request()->all()))
                @component('components.chip', [
                  'label' => 'پاک کردن',
                  'icon' => 'clear',
                  'href'  =>  route('profile.schools.forms.index', $school),
                  'close' =>  true,
                ])
                @endcomponent
            @endif
        </div>
        @component('components.form', [
        ])
            @component('components.modal', ['id' => 'form_types_modal', 'header' => 'انواع فرم',
              'buttons' => [
                ['label' => 'فیلتر'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
                @foreach($types as $id => $label)
                    @component('components.form.checkbox', [
                    'name' => "types[]",
                    'label' => $label,
                    'value' => $id,
                    'checked' => in_array($id , request('types', [])),
                    'inline' => true,
                    ])
                    @endcomponent
                @endforeach
            @endcomponent
            @component('components.modal', ['id' => 'description_modal', 'header' => 'توضیح',
              'buttons' => [
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'بستن']
              ]
            ])
                <strong>
                    تولید صورتجلسه سال جاری، به "برگه بیمه‌شدگان" انتقال پیدا کرده است.
                    برای رفتن به "برگه بیمه‌شدگان"
                    <a href="{{ route('profile.schools.insureds.index', [$school]) }}">اینجا کلیک کنید</a>
                </strong>

            @endcomponent
            <table>
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نوع</th>
                    <th>عنوان</th>
                    <th>سال تحصیلی</th>
                    <th>وضعیت</th>
                    <th>ایجاد کننده</th>
                    <th>تاریخ ایجاد</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($letters as $letter)
                    @component('components.tr', [
                      'columns' => [
                        $loop->iteration,
                        Letter::types()->get($letter->type),
                        isset($letter->data['title']) ? $letter->data['title'] : null,
                        isset($letter->data['academic_year']) ? $letter->data['academic_year'] : null,
                        Insured::statuses()->get($letter->status),
                        $letter->user->fullname,
                        jdate($letter->created_at)->format("d F Y - H:i:s"),
                      ],
                      'href' => route('profile.schools.forms.show', [$school, $letter]),
                    ])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        @endcomponent
        <div class="padding">
            <div class="clearfix"></div>
        </div>
    @endcomponent
@endsection
