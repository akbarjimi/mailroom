@extends('profile.layout')
@section('title',"درون ریزی")
@section('content')
    @component('components.sheet',[
      'header' => 'درون ریزی بیمه شدگان',
      'tabs' => [
          ['title' => ' نمایش', 'link' => route("profile.schools.show", $school)],
          ['title' =>  'بیمه شدگان', 'link'  =>  route("profile.schools.insureds.index", $school) ],
          ['title' => 'گزارش‌ها', 'link' => route('profile.schools.forms.index', $school)],
          ['title' => 'درون ریزی'],
      ]
    ])

        <div class="padding-half">
            <i class="material-icons">add</i>
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'افزودن درون ریزی',
                'href'  =>  route('profile.schools.imports.create', $school)
            ])
            @endcomponent

            @if($school->formOneIsNotMade() && $school->checkStaffAndStudentsUpdated())
                @component('components.chip', [
                  'label' => 'تولید صورتجلسه سال جاری',
                  'icon' => 'assignment',
                  'icon_href' => 'ggg',
                  'href'  =>  route('profile.schools.forms.create', [$school,'', 'type' => Letter::FORM_ONE]),
                  'class' => "modal-trigger pointer"
                ])
                @endcomponent
            @endif
        </div>
        <table>
            <thead>
            <tr>
                <th>ردیف</th>
                <th>تاریخ</th>
                <th>کاربر</th>
                <th>نام فایل</th>
                <th>توضیحات</th>
                <th>تعداد رکورد</th>
                <th>پردازش شده</th>
                <th>خطا</th>
                <th>توضیحات</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($imports as $import)
                @component('components.tr',[
                  'class' => array_get($import->extra, 'errors', null) ? 'warning' : null,
                  'columns' => [
                    $loop->iteration + ( ($imports->currentPage()-1) * $imports->perPage() ),
                    optional($import->created_at)->diffForHumans(),
                    $import->user->fullname,
                    $import->file_name,
                    $import->description,
                    $import->count,
                    $import->index,
                    $import->failed,
                    array_has($import->extra, 'errors') ? trans('strings/alerts.system_error') : '',
                  ],
                  'menu_id' => 'action' . $import->id,
                  'menu' => [
                    [
                        'href' => route('profile.schools.imports.download',[$school, $import]),
                        'icon' => 'save_alt',
                        'class' => '',
                        'label' => 'دانلود'
                    ],
                    [
                        'href' => route('profile.schools.imports.export',[$school, $import]),
                        'icon' => 'broken_image',
                        'class' => '',
                        'label' => 'خرابیها'
                    ],
                  ]
                ])
                @endcomponent
            @endforeach
            </tbody>
        </table>
    @endcomponent
@endsection
