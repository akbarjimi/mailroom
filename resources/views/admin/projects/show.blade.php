@extends('admin.layout')
@section('title', 'کسر ' . $bill->user->fullname . ' در کد مالی ' . $bill->fin_code)
@section('content')
    @component('components.sheet',[
      'header'    =>  'کسر ' . $bill->user->fullname . ' در کد مالی ' . $bill->fin_code,
      'padding'   =>  true,
      'medium' => true,
      'backlink'  =>  route("admin.bills.index"),
      'tabs'      =>  [
          ['title' => 'نمایش'],
          ['title' =>  'ویرایش', 'link'  =>  route("admin.bills.edit", $bill) ],
      ]
    ])
        @component('components.form.label', [
          'key' => "کد پرسنلی",
          'value' => $bill->user_code
        ])
        @endcomponent

        @component('components.form.label', [
          'key'   => "نام و نام خانوادگی",
          'value' => $bill->user->fullname
        ])
        @endcomponent

        @component('components.form.label', [
          'key' => " منطقه",
          'value' => $bill->region->name
        ])
        @endcomponent

        @component('components.form.label', [
          'key' => "کد مالی",
          'value' => $bill->fin_code
        ])
        @endcomponent

        @component('components.form.label', [
          'key' => "شرح کد مالی",
          'value' => fincode_description($bill->region_id, $bill->fin_code) ?? $bill->fin_code_desc
        ])
        @endcomponent

        @component('components.form.label', [
          'key' => "مبلغ کسر",
          'value' => number_format($bill->payment)
        ])
        @endcomponent

        @component('components.form.label', [
          'key' => "مانده کسر",
          'value' => number_format($bill->main_balance)
        ])
        @endcomponent

        @component('components.form.label', [
          'key'     =>  "ایجاد شده در",
          'value'   =>  $bill->created_at->diffForHumans()
        ])
        @endcomponent

        @component('components.form.label', [
          'key'     =>  "آخرین به روزرسانی",
          'value'   =>  $bill->updated_at->diffForHumans()
        ])
        @endcomponent

        @if($bill->calculated_payment > 0)
            @component('components.form.button', [
              'label'   =>  "پردازش",
              'href'    =>  route('admin.bills.process', $bill)
            ])
            @endcomponent
        @endif
    @endcomponent
@endsection
