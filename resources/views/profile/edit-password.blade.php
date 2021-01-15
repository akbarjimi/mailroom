@extends('profile.layout')
@section('title',isset($employee)?$employee->fullname:$user->fullname)
@section('content')

    @component('components.sheet',[
      'header' => isset($employee)    ?   $employee->fullname :   $user->fullname,
      'medium' => TRUE,
      'padding' => TRUE,
      'tabs' => [
        [
          'link'  => isset($employee) ? route('admin.users.edit.contact', ['user' => $employee])  :   route("profile.edit.contact"),
          'title' => 'اطلاعات تماس'
        ],
        [
          'link' => isset($employee) ? route('admin.users.edit.organ', ['user' => $employee]) :   route('profile.edit.organ'),
          'title' => 'اطلاعات سازمانی',
          'render' => array_key_exists(isset($employee) ? $employee->region_id : $user->region_id, Auth::user()->accesses('users'))
        ],
        [
          'title' => 'تغییر رمز عبور',
        ],
        [
          'link'  => isset($employee) ? route('admin.users.edit.mobile', ['user' => $employee])  :   route("profile.edit.mobile"),
          'title' =>  'تغییر موبایل'
        ],
        [
          'link' => isset($employee) ? route('admin.users.edit.permissions', $employee) : route('profile.edit.permissions'),
          'title' => 'دسترسی ها',
          'render' => array_key_exists(isset($employee) ? $employee->region_id : $user->region_id, Auth::user()->accesses('users'))
        ],
      ]
    ])
        @component('components.form', [
            'action'    =>  isset($employee) ? route('admin.users.update.password', ['user' => $employee]) :   route('profile.update.password'),
            'method'    =>  'PATCH',
            'enctype'   =>  true
        ])
            @if(session('data'))
                @include('profile.password_change.mobile_verification')
            @else
                @include('profile.password_change.set_password')
            @endif
        @endcomponent
    @endcomponent
@endsection
