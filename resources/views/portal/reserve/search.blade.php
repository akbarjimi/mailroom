@extends('portal.layout')
@section('title', 'جستجوی اقامتگاه')
@section('topbar')
  @component('components.reservation-search')@endcomponent
@endsection
@section('content')
  @component('components.hotel-list', compact('hotels'))@endcomponent
@endsection
@section('sidebar')
  <img src="/images/side1.png" class="margin-bottom z-depth-2" >
  <img src="/images/hotel-sidebar/1.jpg" class="margin-bottom z-depth-2" >
  <img src="/images/hotel-sidebar/2.jpg" class="margin-bottom z-depth-2" >
  <img src="/images/hotel-sidebar/3.jpg" class="margin-bottom z-depth-2" >
  <img src="/images/hotel-sidebar/4.jpg" class="margin-bottom z-depth-2" >
@endsection
