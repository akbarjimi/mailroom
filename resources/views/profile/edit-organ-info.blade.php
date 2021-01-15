@extends('profile.layout')
@section('title',isset($employee)?$employee->fullname:$user->fullname)
@section('content')
    @component('components.sheet',[
      'header' => isset($employee)    ?   $employee->fullname :   $user->fullname,
      'medium' => TRUE,
      'padding' => TRUE,
      'tabs' => [
        [
          'link'  => isset($employee) ? route('admin.users.edit.contact', ['user' => $employee->id])  :   route("profile.edit.contact"),
          'title' => 'اطلاعات تماس'
        ],
        [
           'title' => 'اطلاعات سازمانی',
        ],
        [
          'link'  => isset($employee) ? route('admin.users.edit.password', ['user' => $employee->id])  :   route("profile.edit.password"),
          'title' => 'تغییر رمز عبور',
        ],
        [
          'link'  => isset($employee) ? route('admin.users.edit.mobile', ['user' => $employee->id])  :   route("profile.edit.mobile"),
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
          'action'  => isset($employee) ? route('admin.users.update.organ', ['user' => $employee]) : route('profile.update.organ'),
          'method'  => 'PATCH',
          'enctype' => true
        ])
            @component('components.form.text', [
              'name' => 'name',
              'label' => 'نام',
              'value' => old( 'name',isset($employee)  ?   $employee->name   :   $user->name)
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'family',
              'label' => 'نام خانوادگی',
              'placeholder' => 'نام خانوادگی',
              'value' => old( 'family', isset($employee)  ?   $employee->family   :   $user->family)
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'code',
              'label' => 'کد پرسنلی',
              'value' => old( 'code', isset($employee)  ?   $employee->code   :   $user->code)
            ])
            @endcomponent
            @component('components.form.select', [
              'name' => 'position',
              'label' => 'پست سازمانی',
              'options' => $positions,
              'value' => old('position', isset($employee) ? $employee->position : $user->position),
              'select_item' => old('position', isset($employee) ? $employee->position : $user->position),
            ])
            @endcomponent
            @component('components.form.text', [
              'name' => 'national_id',
              'label' => 'کد ملی',
              'value' => old( 'national_id', isset($employee)  ?   $employee->national_id   :   $user->national_id)
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'bank_account',
              'label' => 'شماره حساب',
              'value' => old( 'bank_account', isset($employee)  ?   $employee->bank_account   :   $user->bank_account )
            ])
            @endcomponent

            @component('components.form.text', [
              'name'  => 'net_income',
              'label' => 'خالص دریافتی به ریال',
              'value' => old('net_income', isset($employee) ? $employee->net_income : $user->net_income)
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'father_name',
              'label' => 'نام پدر',
              'value' => old( 'father_name', isset($employee)  ?   $employee->father_name   :   $user->father_name)
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'birthplace',
              'label' => 'محل تولد',
              'value' => old( 'birthplace', isset($employee)  ?   $employee->birthplace   :   $user->birthplace)
            ])
            @endcomponent

            @component('components.form.text', [
              'name' => 'issuance_place',
              'label' => 'محل صدور',
              'value' => old( 'issuance_place', isset($employee)  ?   $employee->issuance_place   :   $user->issuance_place)
            ])
            @endcomponent

            @component('components.form.text', [
        'name' => 'bc_id',
        'label' => 'شماره شناسنامه',
        'value' => old( 'bc_id', isset($employee)  ?   $employee->bc_id   :   $user->bc_id)
      ])
            @endcomponent

            @component('components.form.date', [
              'name'  =>  'birthdate',
              'label' =>  'تاریخ تولد',
              'value' =>  old('birthdate', GSTOJS(isset($employee) ? $employee->birthdate : $user->birthdate)),
              'min'   => "1300/01/01",
              'max'   => jdate()->format("Y/m/d"),
            ])
            @endcomponent

            
            @component('components.form.select', [
              'name' => 'employment_type',
              'label' => 'نوع استخدام',
              'options' => enum('user.employment_types')->pluck('label', 'id'),
              'value' => old( 'employment_type', isset($employee)   ?   $employee->employment_type    :   $user->employment_type),
              'select_item'   =>  isset($employee)   ?   $employee->employment_type    :   $user->employment_type,
            ])
            @endcomponent          

            @component('components.form.select', [
              'name' => 'region_id',
              'label' => 'منطقه',
              'options' =>    $regions,
              'value' => old( 'region_id', isset($employee)   ?   $employee->region_id    :   $user->region_id),
              'select_item'   =>  isset($employee)   ?   $employee->region_id    :   $user->region_id,
            ])
            @endcomponent

            @component('components.form.select', [
              'name' => 'gender',
              'value' => old('gender', isset($employee)  ?   $employee->gender   :   $user->gender),
              'options' => \App\Models\Enum\UserIs::getGenders(),
              'label' => 'جنسیت',
              'select_item'   =>  isset($employee)  ?   $employee->gender   :   $user->gender,
            ])
            @endcomponent

            @component('components.form.select', [
              'name'          =>  'degree',
              'label'         =>  'مدرک تحصیلی',
              'options'       =>  $degrees,
              'select_item'   =>  old('degree', isset($employee)  ?   $employee->degree   :   $user->degree)
            ])
            @endcomponent

            @component('components.form.select', [
              'name' => 'marital',
              'value' => old( 'marital', isset($employee)  ?   $employee->marital   :   $user->marital),
              'options' => ['0' => 'نامشخص',\App\Models\Enum\UserIs::MARRIED => 'متاهل',\App\Models\Enum\UserIs::SINGLE => 'مجرد'],
              'label' => 'وضعیت تاهل',
              'select_item'   =>  old('marital', isset($employee)  ?   $employee->marital   :   $user->marital),
            ])
            @endcomponent

            @component('components.form.select', [
              'name'          =>  'type',
              'label'         =>  'وضعیت',
              'options'       =>  $user_types,
              'select_item'   =>  old('type', isset($employee)  ?   $employee->type   :   $user->type)
            ])
            @endcomponent

            @component('components.form.button', [
              'label' => 'ذخیره',
            ])
            @endcomponent
        @endcomponent
    @endcomponent
@endsection
