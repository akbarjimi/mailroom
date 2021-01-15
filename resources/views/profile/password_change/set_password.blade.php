@component('components.form.text', [
  'name' => 'password',
  'label' => 'رمز عبور',
  'type' => 'password',
])
@endcomponent

@component('components.form.text', [
  'name' => 'password_confirmation',
  'label' => 'تکرار رمز عبور',
  'type' => 'password',
])
@endcomponent

@component('components.form.button', [
  'label' => 'تغییر رمز عبور',
])
@endcomponent