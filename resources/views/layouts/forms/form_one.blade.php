@extends("$section.layout")
@section('title','صورتجلسه')
@section('content')
    @component('components.sheet',[
      'header' => 'صورتجلسه',
      'backlink' => back()->getTargetUrl(),
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'method' => 'POST',
          'action' => route("$section.schools.forms.store", $school)
        ])
            @component('components.form.label',[
              'key' => 'از مدیریت آموزشگاه',
              'value' => $school->name
            ])
            @endcomponent
            @component('components.form.label',[
              'key' => 'کد آموزشگاه',
              'value' => $school->school_code
            ])
            @endcomponent
            @component('components.form.label',[
              'key' => 'به مدیریت منطقه',
              'value' => $school->region->name
            ])
            @endcomponent
            <table>
                <thead>
                <td>کل بیمه شدگان</td>
                <td>کل مشمولان حق بیمه</td>
                <td>کل مبلغ بیمه پرداختی</td>
                <td>کل بیمه‌شدگان رایگان</td>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $all_insured_students }}</td>
                    <td>{{ $all_students_who_paid }}</td>
                    <td>@currency($all_students_who_paid * Insured::fee())</td>
                    <td>{{ $all_insured_students - $all_students_who_paid }}</td>
                </tr>
                </tbody>
            </table>
            @component('components.form.text', [
                'name' => 'student_considerations',
                'label' => 'ملاحظات بیمه شدگان',
                'value' => old('student_considerations'),
            ])
            @endcomponent
            <br>
            <table>
                <thead>
                <td>کل کارکنان</td>
                <td>کل کارکنان بیمه شده</td>
                <td>کل خانواده کارکنان بیمه شده</td>
                <td>جمع</td>
                <td>کل بیمه‌شدگان رایگان</td>
                <td>کل مبلغ بیمه پرداختی</td>
                </thead>
                <tbody>
                <tr>
                    <td>
                        @component('components.form.text', [
                            'name' => 'all_staffs_number',
                            'label' => 'کل کارکنان مدرسه',
                            'value' => old('all_staffs_number'),
                        ])
                        @endcomponent
                    </td>
                    <td>{{ $all_insured_staffs }}</td>
                    <td>{{ $all_insured_staffs_family }}</td>
                    <td>{{ $all_insured_staffs + $all_insured_staffs_family }}</td>
                    <td>{{ $all_insured_staffs - $all_staffs_and_family_who_paid }}</td>
                    <td>@currency($all_staffs_and_family_who_paid * Insured::fee())</td>
                </tr>
                </tbody>
            </table>
            @component('components.form.text', [
                'name' => 'staff_considerations',
                'label' => 'ملاحظات کارکنان',
                'value' => old('staff_considerations'),
            ])
            @endcomponent
            @component('components.form.button',[
              'label' => 'ثبت درخواست',
            ])
            @endcomponent
            @component('components.form.button',[
              'label' => 'انصراف',
              'href' => back()->getTargetUrl(),
              'flat' => true
            ])
            @endcomponent
        @endcomponent

    @endcomponent
@endsection
