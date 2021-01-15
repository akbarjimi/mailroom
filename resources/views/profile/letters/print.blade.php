<style>
  body{
    font-family: 'tahoma';
    direction: rtl;
  }
</style>
<body>
  <div class="">
    <div style="float:right; width: 40%;">
      <div style="background-color: #002f6c; color: #fff; padding: .2em 1em;">
        سامانه رفاهی آموزش و پرورش
      </div>
      <div style="background-color: #eeeeee; font-size: 9px; padding: 1em 1em;">
        بزرگراه بعثت، خیابان خزانه بخارایی، خیابان شهید سمیعی، اداره کل آموزش و پرورش شهرستان های استان تهران
        ۵۵۰۴۱۱۰۲ - ۰۲۱
      </div>
    </div>
    <div style="float:left; width: 40%; text-align:left;">
      تاریخ: {{ jdate( $letter->created_at )->format('Y/m/d') }}<br>
      کد رهگیری: {{ $letter->track->id }}
    </div>
    <div style="clear:both"></div>
  </div>
  <h3 style="text-align:center">بسمه تعالی</h3>
  <p>
    {!! html_entity_decode($letter->body) !!}
  </p>
</body>
