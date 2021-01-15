@extends('profile.layout')
@section('title', 'صورت حساب ' . $invoice->user->fullname . ' در کد مالی ' . $invoice->fin_code)
@section('content')

  @component('components.sheet', [
    'header'    =>  'صورت حساب ' . $invoice->user->fullname . ' در کد مالی ' . $invoice->fin_code,
    'padding'   =>  true,
    'medium'    =>  true,
    'backlink'  =>  isset($employee) ? route("admin.users.invoices",$employee) : route('profile.invoices.index'),
  ])

    @component('components.show',[
      'items' => [
        ['label' => 'کد پرسنلی',          'value' => $invoice->user->code],
        ['label' => 'نام و نام خانوادگی', 'value' => $invoice->user->fullname],
        ['label' => 'کد مالی', 'value',   'value' => $invoice->fin_code],
        ['label' => 'شرح کد مالی سند',    'value' => $invoice->fin_code_desc ?? 'تعریف نشده'],
        ['label' => 'منطقه',              'value' => $invoice->region->name],
        ['label' => 'مقدار کل',           'value' => $invoice->total_amount],
        ['label' => 'تعداد قسط',          'value' => $invoice->bill_count],
        ['label' => 'مبلغ قسط',           'value' => $invoice->bill_amount],
        ['label' => 'وضعیت',              'value' => $invoice->getStatus() ],
        ['label' => 'مانده',              'value' => number_format($invoice->balance())],
        ['label' => 'ماه مالی',           'value' => jdate($invoice->month)->format("F Y")],
        ['label' => 'ایجاد شده در',       'value' => jdate($invoice->created_at)->format( statics()->date->format['long'] )],
        ['label' => 'ویرایش شده در',      'value' => jdate($invoice->updated_at)->format( statics()->date->format['long'] )]
      ]
    ])
    @endcomponent
    <div class="padding">
        <table>
            <thead>
                <th>ردیف</th>
                <th>مبلغ کسر</th>
                <th>مانده کسر</th>
                <th>ماه مالی</th>
                <th>ایجاد شده در</th>
                <th>آخرین به روزرسانی در</th>
            </thead>
            <tbody>
            @forelse($invoice->effect as $effect)
                @component('components.tr',[
                        'columns' => [
                          $loop->iteration,
                          number_format($effect->effect),
                          $invoice->balance($effect->bill->month),
                          jdate($effect->month)->format("F Y"),
                          jdate($effect->bill->created_at)->format("d F Y"),
                          jdate($effect->bill->updated_at)->format("d F Y ساعت H:i"),
                        ]
                      ])
                @endcomponent
            @empty
            @endforelse
            </tbody>
        </table>
    </div>
  @endcomponent
@endsection
