@extends('profile.layout')
@section("title","گزارش مفصل کسورات")
@section('content')
  @component('components.sheet',[
    'header' =>  'گزارش مفصل کسورات',
    'backlink' =>  route('profile.index'),
  ])
    <div class="padding">
      <i class="material-icons" >filter_list</i>
      @component('components.chip', [
        'label'     =>  request()->filled('month') ? jdate(JSTOGS(request()->month))->format("F Y") : 'ماه مالی',
        'icon'      =>  'date_range',
        'icon_href' =>  'ggg',
        'target'    =>  'month',
        'active'    =>  request()->filled('month'),
        'class'     =>  'modal-trigger pointer'
      ])
      @endcomponent
      @if(request()->all() !== [])
        @component('components.chip', [
          'label' => 'پاک کردن',
          'icon' => 'clear',
          'href'  =>  route('profile.bills.index'),
          'close' =>  true,
        ])
        @endcomponent
      @endif
      <div class="left mobile-hide">
        {{ $bills->appends(request()->input())->links('components.table-pagination', ['results' => $bills, 'per_page' => true]) }}
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
        <th>پرداختی</th>
        <th>باقیمانده</th>
        <th>ایجاد شده در</th>
        <th>آخرین به روزرسانی در</th>
      </tr>
      </thead>
      <tbody>
      @component("components.form",[
        "action"  =>  route("profile.bills.index"),
        "method"  =>  "GET",
      ])
        @component('components.modal', ['id' => 'month', 'header' => 'تاریخ',
          'buttons' => [
            ['label' => 'اعمال'],
            ['href' => "#!", 'flat' => true, 'class' => 'modal-action modal-close', 'label' => 'انصراف']
          ]
        ])
          @component('components.form.date',[
            'name'    =>  'month',
            'label'   =>  'ماه مالی',
            'value'   =>  request('month', jdate()->format('Y/m')),
            'min'     =>  "1300/01/01",
            "max"     =>  jdate()->format("Y/m/d"),
            'mode'    =>  'month'
          ])
          @endcomponent
        @endcomponent
      @endcomponent
      @forelse($bills as $bill)
        @component('components.tr',[
          'columns' => [
            $loop->iteration + ( ($bills->currentPage()-1) * $bills->perPage() ),
            $bill->user->fullname,
            $bill->region->name,
            fincode_description($bill->region_id, $bill->fin_code) ?? $bill->fin_code_desc,
            number_format($bill->payment),
            $bill->balance,
            jdate($bill->created_at)->format("d F Y"),
            jdate($bill->updated_at)->format("d F Y ساعت H:i"),
          ],
          'href' => route('profile.bills.show', ['bill' =>  $bill]),
        ])
        @endcomponent
      @empty
        <td colspan="8" class="center-align">
          اطلاعات مالی موجود نیست
        </td>
      @endforelse
      </tbody>
    </table>
    <div class="padding">
      <div class="left">
        {{ $bills->appends(request()->input())->links('components.table-pagination', ['results' => $bills, 'per_page' => true]) }}
      </div>
      <div class="clearfix"></div>
  @endcomponent
@endsection
