@extends('profile.layout')
@section('title','رزروها')
@section('content')
  @component('components.sheet',[
    'header' => 'رزروها',
  ])
    <div class="padding">
      <div class="left">
        {{ $reserves->appends(request()->input())->links('components.table-pagination', ['results' => $reserves, 'per_page' => true]) }}
      </div><div class="clearfix"></div>
    </div>
    <table>
      <thead>
        <tr>
          <th>ردیف</th>
          <th>سفارش دهنده</th>
          <th>ثبت کننده</th>
          <th>تاریخ ورود</th>
          <th>تاریخ خروج</th>
          <th>هتل</th>
          <th>هزینه</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reserves as $reserve)
          @component('components.tr', [
            'columns' => [
              $loop->iteration + ( ($reserves->currentPage()-1) * $reserves->perPage() ),
              $reserve->user->fullname,
              $reserve->creatorUSer->fullname,
              jdate($reserve->start)->format('Y/m/d'),
              jdate($reserve->finish)->format('Y/m/d'),
              $reserve->hotel->name,
              number_format($reserve->cost)
            ],
            'href' => route('admin.users.reserves.show', [$employee, $reserve]),
          ])

          @endcomponent
        @endforeach
      </tbody>
    </table>

    <div class="padding">
      <div class="left">
        {{ $reserves->appends(request()->input())->links('components.table-pagination', ['results' => $reserves, 'per_page' => true]) }}
      </div><div class="clearfix"></div>
    </div>
  @endcomponent
@endsection
