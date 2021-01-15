@extends('profile.layout')
@section('content')
  @component('components.sheet',[
    'header' =>  'گزارش مفصل صورت حساب ها',
    'backlink' =>  route('profile.index'),
  ])
    <div class="padding">
      <div class="left mobile-hide">
        {{ $invoices->appends(request()->input())->links('components.table-pagination', ['results' => $invoices, 'per_page' => true]) }}
      </div>
      <div class="clearfix"></div>
    </div>    
    <table>
      <thead>
      <tr>
        <th>ردیف</th>
        <th>کاربر</th>
        <th>منطقه</th>
        <th>کد مالی</th>
        <th>مبلغ کل</th>
        <th>تعداد اقساط</th>
        <th>مبلغ قسط</th>
        <th>وضعیت</th>
        <th>تاریخ ایجاد</th>
        <th>آخرین به روزرسانی</th>
      </tr>
      </thead>
      <tbody>
      @forelse($invoices as $invoice)
        @component('components.tr',[
          'columns' => [
            $loop->iteration + ( ($invoices->currentPage()-1) * $invoices->perPage() ),
            $invoice->user->fullname,
            $invoice->region->name,
            fincode_description($invoice->region_id, $invoice->fin_code) or $invoice->fin_code_desc,
            number_format($invoice->total_amount),
            $invoice->bill_count,
            $invoice->bill_amount,
            $invoice->getStatus(),
            jdate($invoice->created_at)->format("d F Y"),
            jdate($invoice->updated_at)->format("d F Y"),
          ],
          'href' => route('profile.invoices.show', ['invoice' =>  $invoice]),
        ])
        @endcomponent
      @empty
        <td colspan="10" class="center-align">
          اطلاعات مالی موجود نیست
        </td>
      @endforelse
      </tbody>
    </table>
    <div class="padding">
      <div class="left">
        {{ $invoices->appends(request()->input())->links('components.table-pagination', ['results' => $invoices, 'per_page' => true]) }}
      </div>
      <div class="clearfix"></div>
    </div>
  @endcomponent
@endsection
