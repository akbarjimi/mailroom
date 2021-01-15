@extends('portal.layout')
@section('title', 'sdfsdf')
@section('topbar')
    @component('components.reservation-search', compact('hotel'))@endcomponent
@endsection
@section('content')
  @component('components.hotel-info', compact('hotel'))@endcomponent
  @component('components.room-type-list', compact('hotel'))@endcomponent
@endsection
@section('sidebar')
  @component('components.reserve-cart', compact('hotel'))@endcomponent
@endsection
