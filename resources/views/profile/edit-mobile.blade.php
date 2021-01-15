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
          'link' => isset($employee) ? route('admin.users.edit.password', ['user' => $employee]) :   route('profile.edit.password'),
          'title' => 'تغییر رمز عبور',
        ],
        [
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
        'action'  =>  isset($employee) ? route('admin.users.update.mobile', ['user' => $employee]) :   route('profile.update.mobile'),
        'method'  =>  'PATCH',
        ])
            @if(session('verification_code'))
                @include('profile.mobile_change.mobile_verification')
            @else
                @include('profile.mobile_change.set_mobile')
            @endif
        @endcomponent
    @endcomponent
@endsection
