@extends('profile.layout')
@section('content')
  <div class="container margin-v">
    @component('components.reservation-search', compact('hotel'))@endcomponent
    <div class="row side-align">
      <div class="col s8-4 hotel-info">
        @component('components.hotel-info', compact('hotel'))@endcomponent
        @component('components.room-type-list', compact('hotel'))@endcomponent
      </div>
      <div class="col s3-6">
        @component('components.reserve-cart', compact('hotel'))@endcomponent
      </div>
    </div>
  </div>
@endsection
