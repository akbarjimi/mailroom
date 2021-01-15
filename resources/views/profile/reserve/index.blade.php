@extends('profile.layout')
@section('title','رزروها')
@section('content')
  @component('components.sheet',[
    'header' => 'رزروها',
    'medium' => true,
    'backlink' => route('profile.index')
  ])
    <div class="padding">
      <i class="material-icons" >add</i>
      @component('components.chip',[
          'active'=> true,
          'class' => 'info',
          'label' => 'رزرو جدید',
          'href'  => route('profile.reserve'),
      ])
      @endcomponent
      <div class="left">
        {{ $reserves->appends(request()->input())->links('components.table-pagination', ['results' => $reserves, 'per_page' => true]) }}
      </div>
      <div class="clearfix"></div>
    </div>
    <table>
      <thead>
        <tr>
          <th>هتل</th>
          <th>تاریخ ورود</th>
          <th>تاریخ خروج</th>
          <th>تعداد نفرات</th>
          <th>هزینه</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reserves as $reserve)
          @component('components.tr', [
            'columns' => [
              $reserve->hotel->name,
              jdate($reserve->start)->format('d F Y'),
              jdate($reserve->finish)->format('d F Y'),
              $reserve->adult,
              number_format($reserve->cost),
            ],
            'href' => isset($employee)?
                route('admin.users.reserves.show', [$employee, $reserve]):
                route('profile.reserves.show', $reserve)
          ])
          @endcomponent
        @endforeach
      </tbody>
    </table>
    <div class="padding">
      <div class="left">
        {{ $reserves->appends(request()->input())->links('components.table-pagination', ['results' => $reserves, 'per_page' => true]) }}
      </div>
      <div class="clearfix"></div>
    </div>
  @endcomponent
@endsection
