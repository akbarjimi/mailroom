@extends('profile.layout')
@section('title', isset($employee) ? $employee->fullname : $user->fullname)
@section('content')
    @component('components.sheet',[
      'header' => isset($employee)    ?   $employee->fullname : $user->fullname,
      'medium' => TRUE,
      'padding' => TRUE,
      'tabs' => [
        [ 'title' => 'اطلاعات تماس' ],
        [
          'link' => isset($employee) ? route('admin.users.edit.organ', $employee) : route('profile.edit.organ'),
          'title' => 'اطلاعات سازمانی',
          'render' => !empty(Auth::user()->accesses('users')),
        ],
        [
          'link' => isset($employee) ? route('admin.users.edit.password', $employee) : route('profile.edit.password'),
          'title' => 'تغییر رمز عبور',
        ],
        [
          'link' => isset($employee) ? route('admin.users.edit.mobile', $employee)   : route('profile.edit.mobile'),
          'title' => 'تغییر موبایل',
        ],
        [
          'link' => isset($employee) ? route('admin.users.edit.permissions', $employee) : route('profile.edit.permissions'),
          'title' => 'دسترسی ها',
          'render' => !empty(Auth::user()->accesses('users')),
        ],
      ]
    ])
        @component('components.form', [
          'action' => isset($employee) ? route('admin.users.update.contact', ['user' => $employee]) : route('profile.update.contact'),
          'method' => 'PATCH',
          'enctype' => true
        ])
            @component('components.form.text', [
              'name' => 'tel',
              'label' => 'تلفن ثابت',
              'value' => old( 'tel', isset($employee)   ?   $employee->tel  : $user->tel)
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'email',
              'label' => 'ایمیل',
              'value' => old( 'email', isset($employee)   ?   $employee->email  : $user->email )
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'address',
              'label' => 'آدرس',
              'value' => old( 'address', isset($employee)   ?   $employee->address  : $user->address )
            ])
            @endcomponent
            <br>

            <div class="file-field input-field">
                <div class="btn">
                    <span> عکس پرسنلی </span>
                    <input type="file" name="avatar">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <br>

            @component('components.form.button', [
              'label' => 'ذخیره',
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
