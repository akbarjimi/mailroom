@component('components.form.text', [
  'name' => 'verificationCode',
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
  'href' => route('profile.edit.contact'),
])
@endcomponent