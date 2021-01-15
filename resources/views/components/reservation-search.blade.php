<div class="row secondary-highlight z-depth-2 margin-bottom padding-v padding-h-half reservation-search-form fix-under-menu-top radius">
  @component('components.form')
    <div class="col m3 s12 text-primary">
      انتخاب شهر:      
      <div class="input-field city-hotel-inputzz invert">
        @php 
          $cities = App\Models\City::all()->sortBy('name')->pluck("name", "id"); 
          $city = isset(Request()->reserve['city'])? Request()->reserve['city']: $cities->keys()->first();
          if(isset(request()->route()->parameters['hotel'])) $city = $hotel->city_id;
        @endphp
        @component('components.form.select', ['name' => 'city', 'disabled' => isset(request()->route()->parameters['hotel']),
          'invert' => true, 'options' => $cities, 'select_item' => request()->get('city', $cities->keys()->first())
        ])
        @endcomponent
      </div>
    </div>
    <div class="col m3 s6 text-primary">
      تاریخ ورود:
      @component('components.form.date', [ 'name' => 'start', 'invert' => true, 'min' => jdate()->format("Y/m/d"),
        'value' => request()->get('start', '')
      ])
      @endcomponent
    </div>
    <div class="col m3 s6 text-primary">
      مدت اقامت:
      @php
          $access = request()->route()->parameters['hotel']->access ?? [];
          for ($i=($access['min'] ?? 1); $i <= ($access['max'] ?? 8); $i++) $nights[$i] =  $i . ' شب';
      @endphp
      @component('components.form.select', [ 'name' => 'night', 'label' => 'نفرات', 'invert' => true,
        'select_item' => request()->get('night', '3'),
        'options' => $nights
      ])
      @endcomponent
    </div>
    {{-- <div class="col m2 s6 text-primary">
      مسافرین بالای ۴ سال:
      @component('components.form.select', [ 'name' => 'reserve[adult]', 'label' => 'نفرات', 'invert' => true,
        'select_item' => isset(Request()->reserve['adult'])? Request()->reserve['adult']: '',
        'options' => [ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8' ]
      ])
      @endcomponent
    </div> --}}
    <div class="col m2 s6">
      <br>
      @component('components.form.button',[ 'label' => 'جستجو', 'class' => 'invert' ]) @endcomponent
    </div>
  @endcomponent
</div>
