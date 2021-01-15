@php
  if (isset(request()->route()->parameters['user'])) 
    $hotels_link = route('admin.users.reserve', request()->route()->parameters['user']);
  elseif (request()->route()->uri == "reserve/hotel/{hotel}")
    $hotels_link = route('reserve');
  else 
    $hotels_link = route('profile.reserve');
  $available = false;
  foreach ($hotel->roomTypes as $roomtype)
    if ($roomtype->stats[2]) $available = true;
@endphp
<div class="white z-depth-2 margin-bottom center-align fix-under-menu reserve-cart radius">
  <div class="padding">
    @if( isset(request()->start) && isset(request()->night) )
      @if ($available)
        <div class="flex-display">
          <h3 class="title margin-0"> مجموع سفارش به ازای {{ request()->night }} شب </h3>
          <div class="title green-text margin-v">
            <span class="reserve-cost" days="{{ request()->night }}">0</span> ریال
          </div>
        </div>
        <div class="reserve-form-responsive">
          @component('components.form.select', [ 'name' => 'adult', 'label' => 'تعداد مسافرین بالای ۴ سال',
            'select_item' => old('adult', 2),
            'options' => [
              1 => '1 نفر', 2 => '2 نفر', 3 => '3 نفر', 4 => '4 نفر', 5 => '5 نفر',
              6 => '6 نفر', 7 => '7 نفر', 8 => '8 نفر', 9 => '9 نفر', 10 => '10 نفر',
              11 => '11 نفر', 12 => '12 نفر', 13 => '13 نفر', 14 => '14 نفر', 15 => '15 نفر',
            ]
          ])
          @endcomponent
          <div class="">
            @component('components.form.button', [
              'href'  =>  $hotels_link, 'flat'  =>  TRUE, 'label' => 'جستجو دیگر هتل ها'
            ])
            @endcomponent
          </div>
          <div class="submit-btn">
            @component('components.form.button', [ 'name' => 'reserve', 'label' => 'ثبت رزرو' ]) @endcomponent
          </div>
        </div>
      @else
        <h3 class="title margin-0">در این بازه زمانی اتاقی موجود نیست</h3>
        <div>
          @component('components.form.button', [
            'href'  =>  $hotels_link, 'flat'  =>  TRUE, 'label' => 'جستجو دیگر هتل ها'
          ])
          @endcomponent
        </div>
      @endif
    @else
      <h3 class="title margin-0">برای ثبت رزرو باید تاریخ اقامت خود را مشخص کنید</h3><br>
      @component('components.form.button', [
        'href'  =>  $hotels_link, 'flat'  =>  TRUE, 'label' => 'جستجو دیگر هتل ها'
      ])
      @endcomponent
    @endif
  </div>
</div>