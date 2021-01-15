@extends('portal.layout')
@section('title','خطا')
@section('content')
    <div class="white z-depth-1 padding">
        @isset($title)
            <h1 class="headline margin-0">{{ $title }}</h1>
        @endisset
        <div class="padding-v">{{ $message }}</div>
    </div>
@endsection
@section('sidebar')
  <img src="/images/side1.png" class="margin-bottom z-depth-1 radius" >
@endsection
