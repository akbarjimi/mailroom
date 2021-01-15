@php
  $gant = null;
  if (isset(request()->start) && isset(request()->night)) {
    $start = new \DateTime(JSTOGS(request()->start));
    $finish = (clone $start)->modify('+'. request()->night .' days');
    for ($i=-2; $i < 3 ; $i++)
      $gant[] = [jdate((clone $start)->modify("$i days")), jdate((clone $finish)->modify("$i days"))];
  }
@endphp
@forelse ($hotels as $hotel)
  @php
    if (isset(request()->route()->parameters['user'])) {
      $link = route('admin.users.reserve.hotel', array_merge(['user' => request()->route()->parameters['user'], 'hotel' => $hotel], request()->except('user')) );
      $glink = route('admin.users.reserve.hotel', [request()->route()->parameters['user'], $hotel]) . '?';
    }else if (request()->route()->uri == "profile/reserve"){
      $link = route('profile.reserve.hotel', array_merge(['hotel' => $hotel], Request()->all()) );
      $glink = route('profile.reserve.hotel', $hotel) . '?';
    }else{
      $link = route('reserve.hotel', array_merge(['hotel' => $hotel], Request()->all()) );
      $glink = route('reserve.hotel', [$hotel]) . '?';
    }
    if (isset(request()->city)) $glink .= 'city=' . request()->city . '&';
    // if (isset(request()->reserve['adult'])) $glink .= 'reserve[adult]=' . request()->reserve['adult'] . '&';
    if (isset(request()->night)) $glink .= 'night=' . request()->night . '&';
  @endphp
  <div class="white padding col s12 padding-right-0 padding-left-0 margin-bottom z-depth-1 relative radius reserve-card">
    <div class="col s4 padding-right-0 relative">
      <a href="{{ $link }}">
        @if ($hotel->media->isNotEmpty())
          <img src="{{ $hotel->media->sortBy('order_column')->first()->getFullUrl('thumb') }}" alt="">
        @else
          <img src="{{ asset('images/hotel-teaser.jpg') }}" alt="">
        @endif
      </a>
    </div>
    <div class="col s5 padding-v padding-left relative border-left">
      <a href="{{ $link }}"><h2 class="title margin-0">{{ $hotel->name }}</h2></a>
      <div class="margin-bottom caption">
        <i class="material-icons tiny">place</i>
        {{ $hotel->city->name }}
      </div>
      اقامت:‌ {{ $hotel->min_night }} @if($hotel->min_night != $hotel->max_night) الی {{ $hotel->max_night }} @endif شب
      <div class="clearfix"></div>
      @foreach ($hotel->featuresData() as $feature)
        <div class="col  m3 s4 center-align caption">
          <i class="material-icons tiny">{{ $feature['icon'] }}</i><br>{{ $feature['name'] }}
        </div>
      @endforeach
    </div>
    <div class="col s3 center-align padding-v-half">
      @if ($gant)
        <div class="@if ($hotel->stats[2]) green @else red @endif  center-align inline-block text-bold white-text padding-h darken-2 radius">
          {{ "{$gant[2][0]->format('d F')}  الی  {$gant[2][1]->format('d F')}" }}
          @if ($hotel->stats[2]) {{$hotel->stats[2]}} اتاق موجود است @else موجود نیست @endif              
        </div>
      @endif
      @if ($gant && $hotel->stats[2] == 0)
        @if (max($hotel->stats))  @endif
        <div style="width:100%;">
          <p style="margin: 0">پیشنهادات سامانه</p>
          <div >

            @foreach ($hotel->stats as $i => $stat)
              @if ($stat)
                <a href="{{$glink . 'start=' . $gant[$i][0]->format('Y/m/d')}}" style="background-color : green; margin-bottom: 3px; width:100%; padding: 0 5px; color: white; font-size: 14px;" class="radius reserve-offer">
                  {{ "{$gant[$i][0]->format('d F')}  الی  {$gant[$i][1]->format('d F')} $stat اتاق" }}
                </a>
              @endif
            @endforeach
          </div>
        </div>
      @endif
      <p>
        شروع قیمت از <br>
        <span class="green-text">
          @currency( $hotel->roomtypes->sortBy('price')->first()['price'] )
        </span>
      </p>
      @if ($gant && $hotel->stats[2])
        @component('components.form.button', [
          'label' => 'رزرو اتاق',
          'href' => $link
        ])
        @endcomponent
      @endif
    </div>
  </div>
@empty
  <div class="white padding title">جستجوی شما نتیجه ای نداشت</div>
@endforelse 