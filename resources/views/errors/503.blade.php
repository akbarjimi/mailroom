@extends('portal.layout')
@section('title','خطا')
@section('content')
    <div class="white z-depth-1 padding">
        <h1 class="headline margin-0">خطای 503</h1>
        <div class="padding-v">در حال به روز رسانی هستیم. به زودی برمیگردیم.</div>
        <a class="btn" href="/"> صفحه اصلی  </a>
        <a class="btn" href="{{ back()->getTargetUrl() }}"> برگشت  </a>
    </div>
@endsection
@section('sidebar')
  <img src="/images/side1.png" class="margin-bottom z-depth-1 radius" >
@endsection