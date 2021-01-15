@component('components.form.text', [
  'name' => 'mobile',
  'label' => 'تلفن همراه',
  'value'   =>  old('mobile',isset($employee)   ?   $employee->mobile   :   $user->mobile)
])
@endcomponent

@component('components.form.button', [
  'label' => 'تغییر تلفن همراه',
])
@endcomponent