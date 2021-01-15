@extends('profile.layout')
@section('content')
  <div class="container ">
    <div class="row side-align">
      <div class="col s8-4 hotel-info">
        <div class="white margin-v z-depth-2 padding fix-under-menu-top radius">
          <h2 class="title margin-0 secondary-text">با دقت مطالعه فرمایید</h2>
          {!! $reserve->hotel->terms !!}
        </div>
        <div class="white margin-v z-depth-2 padding radius">
          <h2 class="title margin-0 secondary-text">اطلاعات رزرو</h2>
          @component('components.show', [
            'items' => [
              ['label' => 'مرکز اسکان',           'value' => $reserve->hotel->name],
              ['label' => 'ثبت کننده رزرو',       'value' => $reserve->creatorUser->fullname],
              ['label' => 'ثبت رزرو به نام',      'value' => $reserve->user->fullname],
              ['label' => 'کد پرسنلی',            'value' => $reserve->user->code],
              ['label' => 'تاریخ ورود',           'value' => jdate($reserve->start)->format('d F Y')],
              ['label' => 'تاریخ خروج',           'value' => jdate($reserve->finish)->format('d F Y')],
              ['label' => 'تعداد مسافرین',        'value' => $reserve->adult],
              ['label' => 'هزینه',                'value' => number_format($reserve->cost) . ' ریال'],
              ['label' => 'تخفیف',                'value' => number_format($reserve->discount) . ' ریال'],
            ]
          ])
          @endcomponent
        </div>
        @if ( count($reserve->data['services']) )
          <div class="white margin-bottom z-depth-1">
            <h2 class="padding title margin-0 secondary-text">خدمات جانبی هتل</h2>
            <table>
              <thead><tr><th>خدمت</th><th>قیمت واحد</th><th>تعداد</th><th>قیمت کل</th></tr></thead>
              <tbody>
                @foreach ($reserve->data['services'] as $service)
                  <tr>
                    <td>{{ $service['name'] }}</td>
                    <td>{{ number_format($service['price']) }}</td>
                    <td>{{ $service['count'] }}</td>
                    <td>{{ number_format($service['cost']) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
        @foreach ($reserve->rooms as $index => $room)
          <div class="white margin-bottom z-depth-2 room-services radius">
            <h2 class="title margin-0 secondary-text padding">{{ $room['roomtype_name'] }}</h2>
            <table>
              <thead><tr><th>خدمت</th><th>قیمت واحد</th><th>تعداد</th><th>قیمت کل</th></tr></thead>
              <tbody>
                <tr>
                  <td>{{ $room['roomtype_name'] }}</td>
                  <td>{!! price_range($room['prices']) !!}</td>
                  <td>{{ $reserve->start->diffInDays($reserve->finish) }}</td>
                  <td>{{ number_format($room['cost']) }}</td>
                </tr>
                @foreach ($room['services'] as $service)
                  <tr>
                    <td> {{ $service['name'] }} </td>
                    <td> {{ number_format($service['price']) }} </td>                      
                    <td> {{ $service['count'] }}</td>
                    <td>{{ number_format($service['cost']) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @if (count($room['peoples']))
              <div class="padding">
                <h2 class="title secondary-text margin-0 ">نام و نسبت افراد</h2>
                {{-- @php $people_index = 1; @endphp --}}
                @foreach ($room['peoples'] as $people_index => $people)
                  @if (!empty($people['name']) && !empty($people['relation']))
                    <div class="people">
                      {{ 1 + $people_index }} - نام و نام خانوادگی: {{ $people['name'] }} - 
                      نسبت: {{ $people['relation'] }}
                    </div>
                  @endif
                @endforeach
              </div>
            @endif
          </div>
        @endforeach
        
      </div>
      <div class="col s3-6 padding-v">
        <div class="white z-depth-2 margin-bottom center-align fix-under-menu radius">
          <div class="padding">
            @component('components.form',[
              'action' => route('profile.reserve.payment', request()->route()->parameters['reserve']),
              'method' => 'post',
              'id' => 'reserveform'
            ])
            <div class="flex-display">

              <h3 class="title margin-0 secondary-text">مجموع سفارش به ازای {{ date_diff($reserve->start, $reserve->finish)->format('%a') }} شب</h3>
              <div class="title green-text margin-v">
                <span class="services-costx">{{ number_format($reserve->cost) }}</span> ریال
              </div>
            </div>
              @php
                $hotel_admin = in_array($reserve->hotel->region_id, array_keys(auth()->user()->accesses('hotels')));
              @endphp
              @if ($reserve->hotel->installment || $hotel_admin )
                <div class="flex-display" style="text-align: right">
                    @component('components.form.radio', [ 'name'    =>  'payment',
                      'value'   =>  'online', 'label'   =>  'پرداخت آنلاین',
                      'checked' =>  true,
                    ])
                    @endcomponent
                  @if ($hotel_admin)
                    @component('components.form.radio', [ 'name'    =>  'payment',
                      'value'   =>  'cash', 'label'   =>  'اعتباری مخصوص مدیر',
                    ])
                    @endcomponent
                  @endif
                  @if ($reserve->hotel->installment)
                    @component('components.form.radio', [ 'name'    =>  'payment',
                      'value'   =>  'installment', 'label'   =>  'اقساطی '. $reserve->hotel->installment .' ماهه',
                    ])
                    @endcomponent
                  @endif
                </div>
              @endif
              <div class="reserve-policy">
                @component('components.form.checkbox', [
                  'label' => 'شرایط و اطلاعات رزرو را به مطالعه کرده و می پذیرم.',
                  'name' => 'accept'])
                @endcomponent
              </div>
              @component('components.form.button', [ 'flat'  =>  TRUE, 'label' => 'اصلاح اطلاعات',
                'href'  =>  route('profile.reserve.checkout', request()->route()->parameters['reserve']) ])
              @endcomponent
              @component('components.form.button', ['label' => 'ثبت رزرو'])@endcomponent
            @endcomponent

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
