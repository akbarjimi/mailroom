@extends('profile.layout')
@section('title','بیماران خاص و پرهزینه')
@section('content')
    @component('components.sheet',[
      'header' => 'بیماران خاص و پرهزینه',
      'backlink' => route('profile.schools.insureds.forms.index', [$school, $insured]),
      'medium' => true,
      'padding' => true
    ])
        @component('components.form',[
          'method' => 'POST',
          'action' => route('profile.schools.insureds.forms.store', [
                $school,
                $insured,
                'type' => Letter::FORM_SEVEN,
          ])
        ])
            @component('components.form.label', [
                'key' => 'بیمه شده',
                'value' => $insured->fullname
            ])
            @endcomponent
            @includeWhen($insured->insurance_type == Insured::STUDENTS_EVENTS, 'profile.insureds.forms.form_seven_create_student_template')
            @includeWhen($insured->insurance_type == Insured::REFUGEES, 'profile.insureds.forms.form_seven_create_student_template')
            @includeWhen($insured->insurance_type == Insured::STAFFS_EVENTS, 'profile.insureds.forms.form_seven_create_staff_template')
            @includeWhen($insured->insurance_type == Insured::STAFFS_FAMILY_EVENTS, 'profile.insureds.forms.form_seven_create_staff_template')
            @component('components.form.text', [
                'name' => 'total_costs',
                'label' => 'مبلغ کل هزینه های ارایه شده به عدد',
                'value' => number_format((float) old('total_costs')),
                'class' => 'paid_expense_formula_variables',
            ])
            @endcomponent
            @component('components.form.text', [
                'name' => 'amount_received_from_first_insurer',
                'label' => 'مبلغ دریافتی از بیمه‌گر اول به عدد',
                'value' => number_format((float) old('amount_received_from_first_insurer')),
                'class' => 'paid_expense_formula_variables',
            ])
            @endcomponent
            @component('components.form.text', [
                'name' => 'amount_received_from_supplementary_insurer',
                'label' => 'مبلغ دریافتی از بیمه‌گر مکمل به عدد',
                'value' => number_format((float) old('amount_received_from_supplementary_insurer')),
                'class' => 'paid_expense_formula_variables',
            ])
            @endcomponent
            @component('components.form.button',[
              'label' => 'ذخیره',
            ])
            @endcomponent
            @component('components.form.button',[
              'label' => 'انصراف',
              'href' => route('profile.schools.insureds.forms.index', [$school , $insured]),
              'flat' => true
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
