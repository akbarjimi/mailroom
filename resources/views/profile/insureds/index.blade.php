@extends('profile.layout')
@section('title', $school->name)
@section('content')
    @component('components.sheet',[
      'header' =>  $school->name,
      'backlink'  =>  route("profile.schools.index"),
      'tabs' => [
          ['title' => 'نمایش', 'link' => route('profile.schools.show', $school)],
          ['title' =>  'بیمه شدگان'],
          ['title' => 'گزارش‌ها', 'link' => route('profile.schools.forms.index', $school)],
          ['title' => 'درون ریزی', 'link' => route('profile.schools.imports.index', $school)],
      ],
      ])
        <div class="padding">
            <i class="material-icons">add</i>
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'icon' => 'assignment',
                'label' => 'تولید صورتجلسه سال جاری',
                'href'  =>  route('profile.schools.forms.create', [$school,'', 'type' => Letter::FORM_ONE])
            ])
            @endcomponent

            @component('components.chip', [
              'label' => 'نوع بیمه',
              'icon' => 'filter_list',
              'icon_href' => 'ggg',
              'target' => 'insurance_type_modal',
              'active' => request()->filled('insurance_types'),
              'class' => "modal-trigger pointer"
            ])
            @endcomponent              

            @component('components.chip', [
              'label' => 'نوع پرداخت',
              'icon' => 'payment',
              'icon_href' => 'ggg',
              'target' => 'payment_types_modal',
              'active' => request()->filled('payment_types'),
              'class' => "modal-trigger pointer"
            ])
            @endcomponent

            @component('components.chip', [
              'label' => 'سال تحصیلی',
              'icon' => 'date_range',
              'icon_href' => 'ggg',
              'target' => 'academic_year_modal',
              'active' => request()->filled('academic_year'),
              'class' => "modal-trigger pointer"
            ])
            @endcomponent

            @component('components.chip', [
              'label' => 'دانلود',
              'icon' => 'file_download',
              'href' => request()->fullUrlWithQuery(['download' => true]),
              'class' => true
            ])
            @endcomponent

            @if(!empty(request()->all()))
                @component('components.chip', [
                  'label' => 'پاک کردن',
                  'icon' => 'clear',
                  'href'  =>  route('profile.schools.insureds.index', $school),
                  'close' =>  true,
                ])
                @endcomponent
            @endif

            <div class="left padding-v-halfc mobile-hide">
                {{ $insureds->appends(request()->input())->links('components.table-pagination', ['results' => $insureds, 'per_page' => true]) }}
            </div>
        </div>
        @component('components.form', [
          'action' => route('profile.schools.insureds.index', $school),
        ])
            <div class="padding-1 padding-h" style="background-color: #eee;">
                @component('components.form.text', [
                  'name' => 'search',
                  'placeholder' => 'جستجو در کد یا نام و نام خانوادگی',
                  'value' => request()->filled('search') ? request()->input('search') : null,
                ])
                @endcomponent
            </div>
            @component('components.modal', ['id' => 'payment_types_modal', 'header' => 'نوع پرداخت',
              'buttons' => [
                ['label' => 'فیلتر'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
                @foreach($payment_types as $id => $name)
                    @component('components.form.checkbox', [
                    'name' => "payment_types[]",
                    'value' => $id,
                    'label' => $name,
                    'checked' => in_array($id, request('payment_types', [])),
                    ])
                    @endcomponent
                @endforeach
            @endcomponent

            @component('components.modal', ['id' => 'grade_modal', 'header' => 'مقطع تحصیلی',
              'buttons' => [
                ['label' => 'فیلتر'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
                @foreach($grades as $id => $name)
                    @component('components.form.checkbox', [
                    'name' => "grades[]",
                    'value' => $id,
                    'label' => $name,
                    'checked' => in_array($id, request('grades', [])),
                    ])
                    @endcomponent
                @endforeach
            @endcomponent

            @component('components.modal', ['id' => 'statues_type_modal', 'header' => 'نوع پرداخت',
              'buttons' => [
                ['label' => 'فیلتر'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
                @foreach($statuses as $id => $name)
                    @component('components.form.checkbox', [
                    'name' => "statuses[]",
                    'value' => $id,
                    'label' => $name,
                    'checked' => in_array($id, request('statuses', [])),
                    ])
                    @endcomponent
                @endforeach
            @endcomponent

            @component('components.modal', ['id' => 'academic_year_modal', 'header' => 'سال تحصیلی',
              'buttons' => [
                ['label' => 'فیلتر'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
                @foreach(academic_years() as $id => $label)
                    @component('components.form.radio', [
                    'name' => "academic_year",
                    'label' => $label,
                    'value' => $id,
                    'checked' => request('academic_year') == $id,
                    'inline' => true,
                    ])
                    @endcomponent
                @endforeach
            @endcomponent
            @component('components.modal', ['id' => 'insurance_type_modal', 'header' => 'نوع بیمه',
              'buttons' => [
                ['label' => 'فیلتر'],
                ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
              ]
            ])
                @foreach($insurance_types as $id => $name)
                    @component('components.form.checkbox', [
                    'name' => "insurance_types[]",
                    'value' => $id,
                    'label' => $name,
                    'checked' => in_array($id, request('insurance_types', [])),
                    ])
                    @endcomponent
                @endforeach
            @endcomponent


            <table>
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>کد ملی</th>
                    <th>کد پرسنلی</th>
                    <th>نام و نام خانوادگی</th>
                    <th>نام پدر</th>
                    <th>سال تحصیلی</th>
                    <th>مقطع</th>
                    <th>وضعیت</th>
                    <th>نوع بیمه</th>
                    <th>نوع پرداخت</th>
                </tr>
                </thead>
                <tbody>
                @forelse($insureds as $insured)
                    @component('components.tr',[
                        'columns' => [
                        $loop->iteration + ( ($insureds->currentPage()-1) * $insureds->perPage() ),
                        $insured->national_id,
                        $insured->user_code,
                        $insured->fullname,
                        $insured->father,
                        $insured->academic_year,
                        School::grades()->get($insured->grade),
                        Insured::statuses()->get($insured->status),
                        Insured::types()->get($insured->insurance_type),
                        Insured::payments()->get($insured->payment_type),
                      ],
                        'href'    =>  route('profile.schools.insureds.show', [$insured->school, $insured]),
                        ])
                    @endcomponent
                @empty
                    <td colspan="10" class="center-align">
                        اطلاعات بیمه‌شدگان سال تحصیلی جاری موجود نیست. برای دسترسی به بیمه‌شدگان سال گذشته، از فیلتر <span style="color: red">سال تحصیلی</span> استفاده کنید.
                    </td>
                @endforelse
                </tbody>
            </table>
        @endcomponent
        <div class="padding">
            <div class="left">
                {{ $insureds->appends(request()->input())->links('components.table-pagination', ['results' => $insureds, 'per_page' => true]) }}
            </div>
            <div class="clearfix"></div>
        </div>
    @endcomponent
@endsection
