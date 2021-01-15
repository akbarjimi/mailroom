@extends('portal.layout')
@section('title','404')
@section('content')
    <div class="white z-depth-1 padding">
        <h1 class="headline margin-0">خطای 504</h1>
        <div class="padding-v">
            سرور پاسخی به موقع از سرور بالادست، مورد نیاز برای دسترسی، به منظور تکمیل درخواست دریافت نکرد.
        </div>
        <a class="btn" href="/"> صفحه اصلی </a>
        <a class="btn" href="{{ back()->getTargetUrl() }}"> برگشت </a>
    </div>
@endsection
@section('sidebar')
    <img src="/images/side1.png" class="margin-bottom z-depth-1 radius">
@endsection
