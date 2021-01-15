@extends('profile.layout')
@section('title','کلیه مکاتبات')
@section('content')

  @component('components.sheet',[
    'header' => 'کلیه مکاتبات',
    'medium'  =>  true
  ])
  <div class="padding-half">
    @if(!isset($employee))
      <i class="material-icons" >add</i>
      @component('components.chip',[
          'active'=> true,
          'class' => 'info',
          'label' => 'ثبت درخواست',
          'href'  => route('profile.conversations.create'),
      ])
      @endcomponent
    @endisset
    {{-- <div class="left">
      {{ $conversations->appends(request()->input())->links('components.table-pagination', ['results' => $conversations, 'per_page' => true]) }}
    </div> --}}
    <div class="clearfix"></div>
  </div>
    <table>
      <thead>
        <tr>
          <th>ردیف</th>
          <th>عنوان</th>
          <th>نوع</th>
          <th>تاریخ</th>
          <th>وضعیت</th>
          <th> کد پیگیری </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($conversations as $conversation)
          @component('components.tr',[
                        'columns' => [
                          $loop->iteration + ( ($conversations->currentPage()-1) * $conversations->perPage() ),
                          $conversation->title,
                          $types[$conversation->type] ?? "",
                          jdate($conversation->updated_at)->format("d F Y"),
                          $conversation->is_open ? 'باز' : 'بسته',
                          $conversation->track->first()->id or '',
                      ],
                      'href' => isset($employee)? route('admin.users.conversations.show', [$employee, $conversation]): route('profile.conversations.show', $conversation),
                    ])
           @endcomponent
        @endforeach
      </tbody>
    </table>
  <div class="padding">
    <div class="left">
      {{ $conversations->appends(request()->input())->links('components.table-pagination', ['results' => $conversations, 'per_page' => true]) }}
    </div>
    <div class="clearfix"></div>
  </div>
  @endcomponent

  <div class="sheet  medium  z-depth-3 padding support-info">
    <h2>در صورت نیاز با واحد پشتیبانی تماس بگیرید</h2>
      تهران بزرگراه بعثت خ شهید بخارایی خ شهید سمیعی مقابل درب شمالی پارک بعثت
      - کد پستی :۱۱۸۷۶۱۳۹۱۱
      <div>
        <a href="tel:02155041102">۵۵۰۴۱۱۰۲ <i class="material-icons">phone</i></a>
      </div>
  </div>
@endsection
