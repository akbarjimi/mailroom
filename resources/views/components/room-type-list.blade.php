@php
    $gant = null;
    if (isset(request()->start) && isset(request()->night)) {
      $start = new \DateTime(JSTOGS(request()->start));
      $finish = (clone $start)->modify('+'. request()->night .' days');
      for ($i=-2; $i < 3 ; $i++)
        $gant[] = [jdate((clone $start)->modify("$i days")), jdate((clone $finish)->modify("$i days"))];
    }
    
    if (isset(request()->route()->parameters['user'])) {
      $glink = route('admin.users.reserve.hotel', [request()->route()->parameters['user'], $hotel]) . '?';
    }else if (request()->route()->uri == "profile/reserve/hotel/{hotel}"){
      $glink = route('profile.reserve.hotel', $hotel) . '?';
    }else{
      $glink = route('reserve.hotel', [$hotel]) . '?';
    }
    if (isset(request()->reserve['city'])) $glink .= 'reserve[city]=' . request()->reserve['city'] . '&';
    if (isset(request()->reserve['adult'])) $glink .= 'reserve[adult]=' . request()->reserve['adult'] . '&';
    if (isset(request()->reserve['night'])) $glink .= 'reserve[night]=' . request()->reserve['night'] . '&';
  
@endphp
@component('components.form',[
  'action' => route('profile.reserve.select.rooms'),
  'id' => 'reserveform'
])
  <input type="hidden" name="hotel" value="{{ $hotel->id }}">
  <input type="hidden" name="start" value="{{ request()->start ?? '' }}">
  <input type="hidden" name="night" value="{{ request()->night ?? '' }}">
  <input id="adult" type="hidden" name="adult" value="{{ old('adult', 2) }}">
  <input type="hidden" name="user" value="{{ request()->route()->parameters['user']->id ?? null }}">
  {{-- <input id="cicil" type="hidden" name="cost" value="{{ request()->user ?? '' }}"> --}}
  @foreach ($hotel->roomTypes->sortBy('price') as $roomtype)
    <div class="room-type-card white col s12 margin-bottom z-depth-2 padding-right-0 padding-left-0 radius">
      <div class="padding row margin-0">
        <div class="col s6">
          <h2 class="title margin-0 margin-bottom">{{ $roomtype->name }}</h2>
          @if ($gant)
            @foreach ($roomtype->stats as $i => $stat)
              @if ($stat && $i != 2)
                <a href="{{$glink. 'reserve[start]=' . $gant[$i][0]->format('Y/m/d')}}">
                  {{ "{$gant[$i][0]->format('d F')}  الی  {$gant[$i][1]->format('d F')} $stat نتیجه" }}
                </a><br>
              @endif
            @endforeach
          @endif
          <div class="padding-left margin-left">
            <br><i class="material-icons">people</i> ظرفیت {{ $roomtype->bed }} نفر
          </div>
        </div>
        <div class="col s6">
          @if ($gant)
            <div class="@if ($roomtype->stats[2]) green @else red @endif margin-bottom left center-align left text-bold white-text padding-h-half radius darken-2">
              {{ "{$gant[2][0]->format('d F')}  الی  {$gant[2][1]->format('d F')}" }}<br>
              @if ($roomtype->stats[2]) {{$roomtype->stats[2]}} اتاق موجود است @else موجود نیست @endif <br>              
          </div><div class="clearfix"></div>
          @endif
          @if ($gant && $roomtype->stats[2])
            <div class="left padding-right margin-right">
              {{-- <input type="hidden" name="roomtypesprice[{{$roomtype->id}}]" value="{{$roomtype->price}}"> --}}
              @component('components.form.count',[
                'min' => 0,
                'max' => $roomtype->stats[2],
                'value' => 0,
                'name' => "roomtypes[{$roomtype->id}]",
                'class' => 'roomtype-counter',
                'extra' => $roomtype->price
              ])
              @endcomponent
            </div>
          @endif
          <div class="clearfix left"><br>            
              <span class="title green-text">@currency($roomtype->price)</span><br>
              هزینه اقامت
          </div>
          @isset($roomtype->prices)
            <div class="clearfix left">
              <a class="pointer toggle-btn " target=".toggle-{{ $roomtype->id }}" >جزئیات قیمت</a>
            </div>
          @endisset
        </div>
        @isset($roomtype->prices)
          <div class="col s12 togglable close toggle-{{ $roomtype->id }} padding-h-half margin-0"><br>
            <div class="margin-vc">
              @foreach ($roomtype->prices as $room_price)
                <div class="inline-block padding col m2 s4 border padding-v-half center-align caption">
                  {{jdate($room_price[0])->format('d F')}}<br>
                  @currency($room_price[1])
                </div>
              @endforeach
            </div>
          </div>
        @endisset
      </div>
      <div class="border-top padding">
        
        @foreach ($roomtype->featuresData() as $feature)
          <div class="col  m3 s4 center-align caption">
            <i class="material-icons tiny">{{ $feature['icon'] }}</i><br>{{ $feature['name'] }}
          </div>
        @endforeach
        <div class="clearfix"></div>
      </div>
    </div>
  @endforeach
@endcomponent
