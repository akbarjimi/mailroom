@extends('profile.layout')
@section('content')
  @php
    $roomtypes = $reserve->hotel->roomtypes;
  @endphp
  <div class="container ">
    @component('components.form',[ 'method' => 'post',
      'action' => route('profile.reserve.select.services', request()->route()->parameters['reserve']) ])
      <div class="row side-align">
        <div class="col s8-4 hotel-info">
          <div class="white margin-v z-depth-2 padding fix-under-menu-top radius">
            <h2 class="title margin-0 margin-bottom">اطلاعات رزرو</h2>
            <div class="row">
              <div class="col s6"><strong>مرکز اسکان: </strong>{{ $reserve->hotel->name }}</div>
              <div class="col s6"><strong>تاریخ ورود: </strong>{{ jdate($reserve->start)->format('d F Y') }}</div>
              <div class="col s6"><strong>ثبت رزرو به نام: </strong>{{ $reserve->user->name}} </strong>{{ $reserve->user->family }}</div>
              <div class="col s6"><strong>تاریخ خروج: </strong>{{ jdate($reserve->finish)->format('d F Y') }}</div>
              <div class="col s12"><strong>تعداد مسافرین: </strong>{{ $reserve->adult }} نفر</div>
            </div>
          </div>
          @if ($reserve->hotel->services->count())
            <div class="white margin-bottom z-depth-2 radius">
              <h2 class="padding title margin-0 secondary-text">خدمات جانبی مرکز اسکان</h2>
              <table>
                <thead><tr><th>خدمت</th><th>قیمت واحد (ریال)</th><th></th><th>قیمت کل (ریال)</th></tr></thead>
                <tbody>
                  @foreach ($reserve->hotel->services as $service)
                    <tr>
                      <td>{{ $service->title }}</td>
                      <td>{{ number_format($service->cost($reserve)) }}</td>
                      <td class="service-select" cost="{{ $service->cost($reserve) }}">
                        @if ( $service->selectable == 1 )
                          @component('components.form.checkbox', [
                            'name' => "services[{$service->id}][count]", 'value' => 1,
                            'checked' => isset( old('services', $reserve->data['services'])[$service->id] )
                          ])
                          @endcomponent
                        @else
                          @component('components.form.count', [ 'min' => 0, 'max' => $service->selectable, 
                            'name' => "services[{$service->id}][count]", 'class' => 'service-counter', 
                            'value' => $reserve->data['services'][$service->id]['count'] ?? 0,
                          ])
                          @endcomponent
                        @endif
                      </td>
                      <td class="service-cost">
                        @isset($reserve->data['services'][$service->id]) 
                          {{ $reserve->data['services'][$service->id]['cost'] }}
                        @else
                          0
                        @endisset
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
          @foreach ($reserve->rooms as $index => $room)
            @php $roomtype = $roomtypes->keyBy('id')[ $room['roomtype'] ] @endphp
            <div class="white margin-bottom z-depth-2 room-services radius">
              <h2 class="title margin-0 secondary-text padding">{{ $roomtype->name }}</h2>
              <table>
                <thead>
                  <tr><th>خدمت</th><th>قیمت واحد (ریال)</th><th></th><th>قیمت کل (ریال)</th></tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $roomtype->name }}</td>
                    <td>{!! price_range($room['prices']) !!}</td>
                    <td>{{ datesdiff( $reserve->start, $reserve->finish ) }} شب اقامت</td>
                    <td class="service-room" cost={{ array_sum($room['prices']) }}>
                      {{ number_format(array_sum($room['prices'])) }}
                    </td>
                  </tr>
                  @foreach ($roomtype->services as $service)
                    <tr>
                      <td> {{ $service->title }}</td>
                      <td> {{ number_format($service->cost($reserve)) }} </td>
                      <td class="service-select" cost="{{ $service->cost($reserve) }}" calculat="{{ $service->calculat }}">
                        @if ( $service->selectable == 1 )
                          @component('components.form.checkbox', [
                            'name' => "rooms[{$index}][services][{$service->id}][count]", 'value' => 1,
                            'checked' => isset( old('rooms', $reserve->rooms)[$index]['services'][$service->id]['count'] )
                          ])
                          @endcomponent
                        @else
                          @component('components.form.count', [ 'min' => 0, 'max' => $service->selectable, 
                            'name' => "rooms[{$index}][services][{$service->id}][count]", 'class' => 'service-counter',
                            'value' => old('rooms', $reserve->rooms)[$index]['services'][$service->id]['count'] ?? 0,
                          ])
                          @endcomponent
                        @endif
                      </td>
                      <td class="service-cost">
                        @isset($reserve->rooms[$index]['services'][$service->id]) 
                          {{ $reserve->rooms[$index]['services'][$service->id]['cost'] }}
                        @else
                          0
                        @endisset
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <h2 class="title secondary-text margin-0 padding">نام و نسبت افراد</h2>
              <div class="row">
              @for ($j=0; $j < $roomtype->peoples; $j++)
                <div class=" people col s12 @if($j >= $roomtype->bed) extra @endif">
                  <div class="col s6">
                    @component('components.form.text', [
                      'label' => (1 + $j) . ' - نام و نام خانوادگی',
                      'name' => "rooms[{$index}][peoples][{$j}][name]",
                      'value' => old('rooms')[$index]['peoples'][$j]['name'] ?? $reserve->rooms[$index]['peoples'][$j]['name'] ?? '',
                    ])
                    @endcomponent
                  </div>
                  <div class="col s6">
                    @component('components.form.text', [
                      'label' => 'نسبت',
                      'name' => "rooms[{$index}][peoples][{$j}][relation]",
                      'value' => old('rooms')[$index]['peoples'][$j]['relation'] ?? $reserve->rooms[$index]['peoples'][$j]['relation'] ?? '',
                    ])
                    @endcomponent
                  </div>
                </div>
              @endfor
              </div>
            </div>
            @endforeach
        </div>
        <div class="col s3-6 padding-v">
          <div class="white z-depth-2 margin-bottom center-align fix-under-menu radius">
            <div class="padding">
              <div class="flex-display">
                <h3 class="title margin-0">
                  مجموع سفارش به ازای
                  {{ datesdiff( $reserve->start, $reserve->finish ) }}
                  شب
                </h3>
                <div class="title green-text margin-v">
                  <span class="services-cost">{{ number_format($reserve->cost) }}</span> ریال
                </div>
              </div>
              <div class="reserve-form-responsive">
                @if (in_array($reserve->hotel->region_id, array_keys(auth()->user()->accesses('hotels'))))
                  @component('components.form.text', [
                    'label' => 'تخفیف', 'name' => 'discount', 'value' => old('discount', $reserve->discount) ])
                  @endcomponent
                @endif
                @component('components.form.button', [
                  'href'  =>  route('profile.reserve.hotel', [
                    'hotel' => $reserve->hotel, 'adult' => $reserve->adult,
                    'start' => GSTOJS($reserve->start), 'night' => $reserve->finish->diffInDays($reserve->start)
                  ]),
                  'flat'  =>  TRUE,
                  'label' => 'جستجو مجدد'
                ])
                @endcomponent
                <div class="submit-btn">
                  @component('components.form.button', ['label' => 'ثبت رزرو'])@endcomponent
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endcomponent
  </div>
@endsection
