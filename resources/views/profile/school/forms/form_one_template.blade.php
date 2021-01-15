@component('components.form.label',[
  'key' => 'از آموزشگاه',
  'value' => $school->name . ( $school->school_code? ' با کد ' . $school->school_code :'' )
])
@endcomponent
@component('components.form.label',[
  'key' => 'به مسئول تعاون و امور رفاهی منطقه ',
  'value' => $school->region->name
])
@endcomponent
@component('components.form.label',[
  'key' => 'موضوع',
  'value' => 'ارسال آمار و اطلاعات بیمه شدگان'
])
@endcomponent
<div>
    <p>
        عطف به نامه شماره .......................... مورخ ....../....../.... آمار و اطلاعات دانش آموزان و کارکنان بیمه شده
        به
        شرح ذیل
        اعلام میگردد.
    </p>
</div>
<table>
    <thead>
    <tr>
        <td>تعداد کل دانش آموزان بیمه شده</td>
        <td>تعداد بیمه شدگانی که حق بیمه پرداخت نموده اند</td>
        <td>کل مبلغ حق بیمه پرداختی به شرکت بیمه گر</td>
        <td>تعداد بیمه‌شدگان رایگان</td>
    </tr>
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
@isset($student_considerations)
    @component('components.form.label', [
        'key' => 'ملاحظات دانش آموزان',
        'value' => $student_considerations
    ])
    @endcomponent
@else
    <div id="Hideous">
        @component('components.form.text', [
            'name' => 'student_considerations',
            'label' => 'ملاحظات دانش آموزان',
            'value' => old('student_considerations'),
        ])
        @endcomponent
    </div>
@endisset
<br>
<table>
    <thead>
    <tr>
        <td>کل کارکنان</td>
        <td>تعداد کل کارکنان مشمول پرداخت حق بیمه</td>
        <td>تعداد کل خانواده کارکنان مشمول پرداخت حق بیمه</td>
        <td>جمع</td>
        <td>کل مبلغ حق بیمه پرداختی به شرکت بیمه گر</td>
        <td>کل بیمه‌شدگان رایگان</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            @isset($all_staffs_number)
                {{ $all_staffs_number }}
            @else
                @component('components.form.text', [
                    'name' => 'all_staffs_number',
                    'label' => 'کل کارکنان مدرسه',
                    'value' => old('all_staffs_number'),
                ])
                @endcomponent
            @endisset
        </td>
        <td>{{ $all_insured_staffs_who_paid }}</td>
        <td>{{ $all_insured_staffs_family_who_paid }}</td>
        <td>{{ $all_insured_staffs_who_paid + $all_insured_staffs_family_who_paid }}</td>
        <td>@currency($all_staffs_and_family_who_paid * Insured::fee())</td>
        <td>{{ ($all_insured_staffs + $all_insured_staffs_family) - $all_staffs_and_family_who_paid }}</td>
    </tr>
    </tbody>
</table>
@isset($staff_considerations)
    @component('components.form.label', [
        'key' => 'ملاحظات کارکنان',
        'value' => $staff_considerations
    ])
    @endcomponent
@else
    <div id="Hideous">
        @component('components.form.text', [
            'name' => 'staff_considerations',
            'label' => 'ملاحظات کارکنان',
            'value' => old('staff_considerations'),
        ])
        @endcomponent
    </div>
@endisset
<table>
    <thead>
    <tr>
        <td>مبلغ کل به عدد</td>
        <td>مبلغ کل به حروف</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        @php use App\Models\Insured;$total = ($all_staffs_and_family_who_paid + $all_students_who_paid) * Insured::fee() @endphp
        <td>{{ number_format($total) }}</td>
        <td>{{ (new convertDigitsToWords())->numberToWords($total) }} ریال</td>
    </tr>
    </tbody>
</table>
<div>
    <p style="float: right; width: 49%">
        مدیریت آموزشگاه: {{$school->user->fullname}}
    </p>
    <p style="float: left; width: 49%">
        مسئول تعاون و امور رفاهی منطقه: {{$school->region->user->fullname}}
    </p>
</div>