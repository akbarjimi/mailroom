@extends('profile.layout')
@section('title','رزرو')
@section('content')
  @component('components.sheet',[
    'header' => 'اطلاعات رزرو ' . $reserve->hotel->name,
    'backlink' => isset($employee)? route('admin.users.reserves.index', $employee): route('profile.reserves.index'),
    'medium' => true,
    'padding' => true
  ])
    @component('components.show', [
      'items' => [
        ['label' => 'مرکز اسکان',           'value' => $reserve->hotel->name],
        ['label' => 'ثبت کننده رزرو',       'value' => $reserve->creatorUser->fullname],
        ['label' => 'ثبت رزرو به نام',      'value' => $reserve->user->fullname],
        ['label' => 'کد پرسنلی',            'value' => $reserve->user->code],
        ['label' => 'تاریخ ورود',           'value' => jdate($reserve->start)->format('d F Y')],
        ['label' => 'تاریخ خروج',           'value' => jdate($reserve->finish)->format('d F Y')],
        ['label' => 'تعداد مسافرین',        'value' => $reserve->adult],
        ['label' => 'هزینه',                'value' => number_format($reserve->cost)],
        ['label' => 'تخفیف',                'value' => number_format($reserve->discount)],
        ['label' => 'تاریخ ثبت',            'value' => jdate($reserve->created_at)->format( statics()->date->format['long'] )],
      ]
    ])
    @endcomponent
  @endcomponent
  <div class="container medium">
    @foreach ($reserve->rooms as $index => $room)
      <div class="white margin-bottom z-depth-3 room-services radius">
        <h2 class="title margin-0 secondary-text padding">{{ $room['roomtype_name'] }}</h2>
        <table>
          <thead><tr><th>خدمت</th><th>قیمت واحد</th><th>تعداد</th><th>قیمت کل</th></tr></thead>
          <tbody>
            <tr>
              <td>{{ $room['roomtype_name'] }}</td>
              <td>{!! price_range($room['prices']) !!}</td>
              <td>{{ $reserve->start->diffInDays($reserve->finish) }}</td>
              <td class="service-cost">{{ $room['cost'] }}</td>
            </tr>
            @foreach ($room['services'] ?? [] as $service)
              <tr>
                <td> {{ $service['name'] }} </td>
                <td> {{ $service['price'] }} </td>                      
                <td>{{ $service['count'] }} </td>
                <td>{{ $service['cost'] }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="padding">
          <h2 class="title secondary-text margin-0 ">نام و نسبت افراد</h2>
          @php $people_index = 1; @endphp
          @foreach ($room['peoples'] as $people)
            <div class="people">
              {{ $people_index++ }} - نام و نام خانوادگی: {{ $people['name'] }}
              نسبت: {{ $people['relation'] }}
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </div>
@endsection
