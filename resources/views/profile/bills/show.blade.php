@extends('profile.layout')
@section('title', 'کسر ' . $bill->user->fullname . ' در کد مالی ' . $bill->fin_code)
@section('content')
    @component('components.sheet',[
      'header'      =>  'کسر ' . $bill->user->fullname . ' در کد مالی ' . $bill->fin_code,
      'padding'     =>  true,
      'medium'      =>  true,
      'backlink'    =>  isset($employee) ? route("admin.users.bills",$employee) : route('profile.bills.index'),
    ])
        @component('components.show',[
          'items' => [
            ['label' => 'کد پرسنلی',            'value' => $bill->user->code],
            ['label' => 'نام و نام خانوادگی',   'value' => $bill->user->fullname],
            ['label' => 'منطقه', 'value',       'value' => $bill->region->name],
            ['label' => ' کد مالی',             'value' => $bill->fin_code],
            ['label' => 'شرح کد مالی',          'value' => fincode_description($bill->region_id, $bill->fin_code) ?? $bill->fin_code_desc],
            ['label' => 'مبلغ کسر',             'value' => $bill->payment],
            ['label' => 'مانده کسر',            'value' => $bill->balance],
            ['label' => 'ایجاد شده در',         'value' => jdate($bill->created_at)->format( statics()->date->format['long'] )],
            ['label' => 'ویرایش شده در',        'value' => jdate($bill->updated_at)->format( statics()->date->format['long'] )]
          ]
        ])
        @endcomponent
    @endcomponent
@endsection
