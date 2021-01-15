@extends('profile.layout')
@section('title',isset($employee)?$employee->fullname:$user->fullname)
@section('content')
    @component('components.sheet',[
      'header' => isset($employee)    ?   $employee->fullname :   $user->fullname,
      'padding' => TRUE,
      'medium' => TRUE,
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
          'link'  => isset($employee) ? route('admin.users.edit.password', ['user' => $employee])  :   route("profile.edit.password"),
          'title' => 'تغییر رمز عبور',
        ],
        [
          'link'  => isset($employee) ? route('admin.users.edit.mobile', ['user' => $employee])  :   route("profile.edit.mobile"),
          'title' =>  'تغییر موبایل'
        ],
        [
          'title' => 'دسترسی ها',
          'render' => array_key_exists(isset($employee) ? $employee->region_id : $user->region_id, Auth::user()->accesses('users'))
        ],
      ]
    ])
        @component('components.form', [
          'action' => $action,
          'method' => 'PATCH',
        ])
            <ul class="collapsible">
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">supervisor_account</i>مناطق</div>
                    <div class="collapsible-body">
                        <table>
                            <thead>
                            <th>منطقه</th>
                            @foreach($permissions->sortBy('name')->pluck('label')->unique() as $name)
                                <th>{{ $name }}</th>
                            @endforeach
                            @foreach($permissions->groupBy('region_name')->sortBy('region') as $region => $region_permissions)
                                <tr>
                                    <td>{{$region}}</td>
                                    @foreach($region_permissions->sortBy('name') as $permission)
                                        <th>
                                            @component('components.form.checkbox', [
                                               'name'      =>  "permissions[{$permission['name']}]",
                                               'value'     =>  $permission['id'],
                                               'checked'   =>  $permission['checked'],
                                               'disabled'  => $permission['disabled'],
                                               'class'     =>  'margin-0x',
                                             ])
                                            @endcomponent
                                        </th>
                                    @endforeach
                                </tr>
                            @endforeach
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </li>
            </ul>
            <br>
            @component('components.form.button', ['label' => 'ذخیره',])@endcomponent
        @endcomponent
    @endcomponent
@endsection
