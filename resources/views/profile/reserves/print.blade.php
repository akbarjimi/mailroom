<style>
  body{ margin:0; padding:0; font-family: iransans; direction: rtl; line-height: 1.5; }
  table{ border-collapse:collapse; }
  th{ text-align: right; font-size: 14px; color: #888; line-height: 30px; }
  td{ font-size: 12px; line-height: 1.8; padding-right: 7px; }
  .width-1-2{ width: 50% }
  .width-1-3{ width: 33.33% }
  .half-width{ width: 50%; }
  .full-width{ width: 100%; }
  .border{ border: 1px solid #bbb; }
  .padding{ padding: 12px; }
  .margin-bottom{ margin-bottom: 10px; }
  .title{ font-weight: bold; font-size: 17px; color: #2a3498; margin-bottom: 10px; }
  .subheading{ font-weight: bold; font-size: 15px; color: #2a3498 }
  @page{
    margin: 180px 30px;
    margin-header: 0px;
    header: page-header;
	  footer: page-footer;
  }
  
  .invert{ background-color: #4a54b8; color: #fff; }
  .invert td{color: #fff;}
  .terms {font-size: 12px; }
  #qr{color: #fff; font-size: 1px;  padding: 0; text-align: left }
  .center{ text-align: center }
</style>
<body>
  <htmlpageheader name="page-header">
    <table class="full-width">
      <tr>
        <td class="width-1-3">
          <img width="160px" src="{{ public_path('images/arm.png') }}" />
        </td>
        <td class="width-1-3 center title">بسمه تعالی</td>
        <td id="qr" class="width-1-3">
          {!! QrCode::size(180)->generate('test QrCode!'); !!}
        </td>
      </tr>
    </table>
  </htmlpageheader>
  <div class="title" >سند رزرو {{ $reserve->hotel->name }}</div>  
  <div class="padding border invert">
    <table class="full-width">
      <tr>
        <td class="width-1-3"><strong>ثبت کننده رزرو:</strong> {{ $reserve->creatorUser->fullname }}</td>
        <td class="width-1-3"><strong>ثبت رزرو به نام:</strong> {{ $reserve->user->fullname }}</td>
        <td><strong>کد پرسنلی:</strong> {{ $reserve->user->code }}</td>
      </tr>
      <tr>
        <td><strong>تاریخ ورود:</strong> {{ jdate($reserve->start)->format('d F Y') }}</td>
        <td><strong>تاریخ خروج:</strong> {{ jdate($reserve->finish)->format('d F Y') }}</td>
        <td ><strong>مدت اقامت: </strong> {{ $reserve->start->diffInDays($reserve->finish) }} شب</td>
      </tr>
      <tr>
        <td><strong>تعداد مسافرین:</strong> {{ $reserve->adult }}</td>
        <td><strong>هزینه:</strong> {{ number_format($reserve->cost) }}</td>
        <td><strong>تاریخ ثبت:</strong> {{ jdate($reserve->created_at)->format( statics()->date->format['long'] ) }}</td>
      </tr>
      @if ($reserve->discount)  
        <tr><td><strong>تخفیف:</strong> {{ number_format($reserve->discount) }}</td></tr>
      @endif
    </table>
  </div>
  <br/>


  @if (count($reserve->data['services'] ?? []))
    <br>
    <div class="title" >خدمات هتل</div>  
    @foreach ($reserve->data['services'] ?? [] as $index => $room)
      <div>v</div>
    @endforeach
  @endif



  @foreach ($reserve->rooms as $index => $room)
    
    <div class="border padding margin-bottom">
      <div class="title" ># {{ $room['roomtype_name'] }} ({{ $room['room_name'] }})</div>
      @if (count($room['services'] ?? []))
        
        <table class="full-width">
          <thead><tr><th>خدمات</th><th>قیمت واحد</th><th>تعداد</th><th>قیمت کل</th></tr></thead>
          @foreach ($room['services'] as $service)
            <tr>
              <td class="border"> {{ $service['name'] }} </td>
              <td class="border"> {{ $service['price'] }} </td>
              <td class="border">{{ $service['count'] }} </td>
              <td class="border">{{ $service['cost'] }}</td>
            </tr>
          @endforeach
        </table>
        <br>
      @endif
      
      @php $people_index = 1; @endphp
      
      <table class="full-width margin-bottom">
        <tr><th>مسافرین</th><th></th><th></th></tr>
        @for ($i = 0; $i < count($room['peoples']); $i+=3)
          <tr>
            @for ($j = 0; $j < 3; $j++)
              @isset($room['peoples'][$i+$j])
                <td class="border width-1-3">{{1+$i+$j}} - {{ $room['peoples'][$i+$j]['name']  }} ({{ $room['peoples'][$i+$j]['relation']  }})</td>
              @endisset
            @endfor
          </tr>
        @endfor  

      </table>

      <!-- <table class="full-width">
        <tr><th>مسافرین</th><th>نام و نام خانوادگی</th><th>نسبت</th></tr>
        
        @foreach ($room['peoples'] as $people)
        <tr>
          <td class="border">{{ $people_index++ }}</td>
          <td class="border">{{ $people['name'] }}</td>
          <td class="border">{{ $people['relation'] }}</td>
        </tr>
        @endforeach
      </table> -->
 
      <table class="full-width">
        <thead><tr><th>هزینه</th><th>قیمت کل</th></tr></thead>
        <tr>
          <td>{!! price_range($room['prices']) !!}</td>
          <td>{{ number_format($room['cost']) }} ریال</td>
        </tr>
      </table>
    </div>
    <br>
  @endforeach
  <div class="title">نکات مرکز اسکان نکات مرکز اسکان نکات مرکز اسکان نکات مرکز اسکان نکات مرکز اسکان</div>
  <div class="terms">
    <!-- <columns column-count="2"  vAlign="J" column-gap="7" /> -->
    
    
    {!! preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $reserve->hotel->terms)  !!}
</div>
  <table class="full-width">
    <tr>
      <td>
        @if ($reserve->hotel->terms)    
          
        @endif
      </td>

    </tr>
  </table>
</body>
