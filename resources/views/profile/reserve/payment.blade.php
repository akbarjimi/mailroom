<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      body{
        margin: 0;
        padding: 0;
      }
      img{
        width: 100%;
      }
    </style>
  </head>
  <body>
  <a href="{{ route('profile.reserve.payed', $reserve) }}">
      <img src="{{ asset('images/payment.png') }}" alt="">
    </a>
  </body>
</html>
