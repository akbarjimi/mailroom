@component('components.form.text', [
    'name' => 'bank_account',
    'label' => 'شماره حساب بانک ملی یا شماره شبای سایر بانک‌ها',
    'value' => old('bank_account', $bank_account ?? ''),
])
@endcomponent
@component('components.form.text', [
    'name' => 'bank_name',
    'label' => 'نام بانک',
    'value' => old('bank_name', $bank_name ?? ''),
])
@endcomponent
@component('components.form.text', [
    'name' => 'branch_code',
    'label' => 'کد شعبه',
    'value' => old('branch_code', $branch_code ?? ''),
])
@endcomponent
@component('components.form.text', [
    'name' => 'bank_account_national_id',
    'label' => 'کد ملی صاحب حساب',
    'value' => old('bank_account_national_id', $bank_account_national_id ?? ''),
])
@endcomponent
@component('components.form.text', [
    'name' => 'bank_account_birth_date',
    'label' => 'تاریخ تولد صاحب حساب',
    'value' => old('bank_account_birth_date', $bank_account_birth_date ?? ''),
])
@endcomponent
@component('components.form.text', [
    'name' => 'tel',
    'label' => 'شماره تماس',
    'value' => old('tel', $tel ?? ''),
])
@endcomponent
@component('components.form.select', [
    'name' => 'relation',
    'label' => 'نسبت',
    'options' => Insured::mainOrSub()->toArray(),
    'select_item' => old('relation', $insured->insurance_type == Insured::STAFFS_EVENTS ? Insured::MAIN : Insured::SUB),
    'class' => 'relation',
])
@endcomponent
@component('components.form.text', [
    'name' => 'patient_national_id',
    'label' => 'کد ملی بیمار',
    'value' => old('patient_national_id', $bank_account_owner_relation ?? ''),
    'class' => 'patient_national_id',
])
@endcomponent
@component('components.form.text', [
    'name' => 'patient_full_name',
    'label' => 'نام و نام خانوادگی بیمار',
    'value' => old('patient_full_name', $patient_name ?? ''),
    'class' => 'patient_full_name',
])
@endcomponent
@component('components.form.text', [
    'name' => 'sickness',
    'label' => 'بیماری',
    'value' => old('sickness',$sickness ?? ''),
])
@endcomponent
@component('components.form.text', [
    'name' => 'sickness_duration',
    'label' => 'سابقه بیماری (مدت بر حسب سال)',
    'value' => old('sickness_duration',$sickness_duration ?? ''),
])
@endcomponent