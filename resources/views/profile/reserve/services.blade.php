@extends('profile.layout')
@section('content')
  <div class="container ">
    <div class="row side-align">
      <div class="col s8-4">
        <div class="">
          <div>{{ $hotel->name }}</div>
          <div>{{ $user->name}} {{ $user->family }}</div>
          <div>{{ $reserve['start'] }}</div>
          <div>{{ $reserve['finish'] }}</div>
        </div>
        @component('components.form',[
          'action' => route('profile.reserve.checkout', array_merge(['hotel' => $hotel]), ['name' => 'omid']),
          'id' => 'reserveform'
        ])
          @component('components.form.hidden',['name' => 'reserve[start]', 'value' => $reserve['start']])@endcomponent
          @component('components.form.hidden',['name' => 'reserve[finish]', 'value' => $reserve['finish']])@endcomponent
          @component('components.form.hidden',['name' => 'reserve[adult]', 'value' => $reserve['adult']])@endcomponent
          @if ($hotel->services->count())
            <div class="white margin-bottom z-depth-1">
              <div class="padding">
                <h2 class="title margin-0 secondary-text">خدمات جانبی هتل</h2>
              </div>
              <table>
                <thead>
                  <tr>
                    <th>خدمت</th>
                    <th>شرح</th>
                    <th>قیمت واحد</th>
                    <th>قیمت کل</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($hotel->services as $service)
                    <tr>
                      <td>{{ $service->title }}</td>
                      <td>{{ $service->description }}</td>
                      <td>{{ $service->price }}</td>
                      <td class="service-cost">0</td>
                      <td class="service-select" cost="{{ $service->cost() }}">@component('components.form.checkbox', [
                        'name' => "reserve[services][{$service->id}]",
                      ])

                      @endcomponent</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif


          @foreach ($reserve['roomtypes'] as $roomtype_id => $roomtype_reserve)
            @php $roomtype = $hotel->roomtypes->keyBy('id')[$roomtype_id] @endphp
            @component('components.form.hidden',['name' => "reserve[roomtypes][{$roomtype_id}][count]", 'value' => $roomtype_reserve['count']])@endcomponent
            @for ($i=0; $i < $roomtype_reserve['count']; $i++)
              <div class="white margin-bottom z-depth-2 room-services radius">
                <h2 class="title margin-0 secondary-text padding">{{ $roomtype->name }}</h2>
                <table>
                  <thead>
                    <tr>
                      <th>خدمت</th>
                      <th>شرح</th>
                      <th>قیمت واحد</th>
                      <th>قیمت کل</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $roomtype->name }}</td>
                      <td></td>
                      <td>{{ $roomtype->price }}</td>
                      <td class="service-cost">{{ $hotel->roomTypes->keyBy('id')[$roomtype->id]->roomStats['reserve_price'] }}</td>
                      <td>
                      @component('components.form.checkbox',[
                        'checked' => TRUE,
                        'disabled' => TRUE
                      ])
                      @endcomponent</td>
                    </tr>
                    @foreach ($roomtype->services as $service)
                      <tr>
                        <td> {{ $service->title }} </td>
                        <td> {{ $service->description }} </td>
                        <td> {{ $service->price }} </td>
                        <td class="service-cost"> 0</td>
                        <td class="service-select" cost="{{ $service->cost() }}" calculat="{{ $service->calculat }}">
                          @if ( $service->selectable == 1 )
                            @component('components.form.checkbox', [
                              'name' => "reserve[roomtypes][{$roomtype->id}][rooms][{$i}][services][{$service->id}]",
                              'value' => 1
                            ])
                            @endcomponent
                          @else
                            @component('components.form.count', [
                              'min' => 0,
                              'max' => $service->selectable,
                              'value' => 0,
                              'name' => "reserve[roomtypes][{$roomtype->id}][rooms][{$i}][services][{$service->id}]",
                              'class' => 'service-counter',
                            ])
                            @endcomponent
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <h2 class="title secondary-text margin-0 padding">نام و نسبت افراد</h2>
                @for ($j=1; $j <= $roomtype->peoples; $j++)
                  <div class="padding-right people @if($j > $roomtype->bed) extra @endif">
                    {{ $j }} - نام و نام خانوادگی:
                    @component('components.form.text', [
                      'name' => "reserve[roomtypes][{$roomtype->id}][rooms][{$i}][peoples][{$j}]['name']",
                      'class' => 'margin-0',
                      'inline' => true
                    ])
                    @endcomponent
                    نسبت:
                    @component('components.form.text', [
                      'name' => 'dd',
                      'class' => 'margin-0',
                      'inline' => true
                    ])
                    @endcomponent
                  </div>
                @endfor
              </div>
            @endfor
          @endforeach
        @endcomponent
      </div>
      <div class="col s3-6 padding-v">
        <div class="white z-depth-2 margin-bottom center-align fix-under-menu radius">
          <div class="padding">
            <h3 class="title margin-0">مجموع سفارش به ازای ۳ شب</h3>
            <div class="title green-text margin-v">
              <span class="services-cost">0</span> تومان
            </div>
            @component('components.form.button', [
              'name' => 'reserve',
              'label' => 'ثبت رزرو'
            ])
            @endcomponent
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
