@extends('profile.layout')
@section('content')
  <div class="container margin-double-v">
    @component('components.reservation-search')@endcomponent
    <div class="row side-align">
      <div class="col s8-4 hotel-info">
        @component('components.hotel-list', compact('hotels'))@endcomponent
      </div>
      <div class="col s3-6 reserve-side-image">
        <img src="/images/side1.png" class="margin-bottom z-depth-2" >
        <img src="/images/hotel-sidebar/1.jpg" class="margin-bottom z-depth-2" >
        <img src="/images/hotel-sidebar/2.jpg" class="margin-bottom z-depth-2" >
        <img src="/images/hotel-sidebar/3.jpg" class="margin-bottom z-depth-2" >
        <img src="/images/hotel-sidebar/4.jpg" class="margin-bottom z-depth-2" >
      </div>
    </div>
  </div>
@endsection
