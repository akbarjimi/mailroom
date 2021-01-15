@component('components.form.text', [
  'name' => 'verification_code',
  'label' => 'کد دریافت شده',
])
@endcomponent
@component('components.form.button', [
  'label' => 'تایید',
])
@endcomponent
@component('components.form.button', [
  'label' => 'انصراف',
  'flat' => true,
  'action' => route('profile.update.mobile',['cancel' => true]),
])
@endcomponent