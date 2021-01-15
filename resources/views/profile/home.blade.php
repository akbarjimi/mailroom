@extends('profile.layout')
@section('title',"پروفایل کاربری")
@section('content')
    @if(Auth::user()->accesses('users', true))
        <div class="container">
            <div class="row side-align margin-v">
                @foreach(\App\Models\Enum\UserIs::getTypes() as $type => $label)
                    @continue($type === \App\Models\Enum\UserIs::ACTIVE_AND_RETIREMENT)
                    <div class="col s6 m3 margin-v-half">
                        <div class="z-depth-1 padding white">
                            <i class="material-icons medium grey lighten-2 padding-half circle left green-text text-lighten-2">person</i>
                            تعداد کاربران {{ $label }}
                            <br>
                            <span class="title red-text text-lighten-2">{{ \App\User::whereType($type)->count() }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @component('components.sheet',['padding' => true])
        <div class="row">
            <div class="col l2 m6 s12">
                <div class="image-cropper valign-wrappe center-align">
                    @if($user->avatar)
                        <img src="/storage/avatars/{{ $user->avatar }}" alt="" class="circle z-depth-1">
                    @else
            <i class="material-icons large secondary-light white-text circle padding">person</i>
          @endif
        </div>
      </div>
      <div class="col pull-l1 l4 m6 s12">
        <h2 class="title">{{ $user->fullname }}</h2>
        @component('components.form.label',[
          'key'    =>  'تراز مالی',
          'value'   =>  $user->balance(),
          ])
        @endcomponent
          @component('components.form.label',[
            'key'    =>  'خالص دریافتی',
            'value'   =>  $user->net_income,
            ])
          @endcomponent
      </div>
      <div class="col l3 m6 s12">
        @component('components.form.label',[
          'key'    =>  'کد پرسنلی',
          'value'   =>  $user->code,
        ])
        @endcomponent
        @component('components.form.label',[
          'key'    =>  'کد ملی',
          'value'   =>  $user->national_id,
        ])
        @endcomponent
        @component('components.form.label',[
          'key'    =>  'محل تولد',
          'value'   =>  $user->birthplace,
        ])
        @endcomponent

        @component('components.form.label',[
          'key'    =>  'محل خدمت',
          'value'   =>  $user->region->name,
        ])
        @endcomponent

        @component('components.form.label',[
          'key'    =>  'تاریخ تولد',
          'value'   =>  strtotime($user->birthdate) ? GSTOJS($user->birthdate) : '',
        ])
        @endcomponent
        @component('components.form.label',[
          'key'    =>  'سن',
          'value'   =>  strtotime($user->birthdate) ?
                            \Carbon\Carbon::parse($user->birthdate)->diff(\Carbon\Carbon::now())->format('%y سال')
                            : '',
        ])
            @endcomponent
      </div>
            <div class="col l3 m6 s12">
                @component('components.form.label',[
                  'key'    =>  'تلفن ثابت',
                  'value'   =>  $user->tel,
                ])
                @endcomponent
                @component('components.form.label',[
                  'key'    =>  'تلفن همراه',
                  'value'   =>  $user->mobile,
                ])
                @endcomponent
                @component('components.form.label',[
                  'key'    =>  'ایمیل',
                  'value'   =>  $user->email,
                ])
                @endcomponent
            </div>
        </div>
    @endcomponent

  @component('components.sheet',['header' =>  '10 صورت حساب اخیر'])
      <table>
          <thead>
          <tr>
              <th>کد مالی</th>
              <th>کل بدهی </th>
              <th>تعداد اقساط </th>
              <th>مبلغ هر قسط</th>
              <th>وضعیت</th>
          </tr>
          </thead>
          <tbody>
          @forelse($recent_invoices as $invoice)
              <tr>
                  <td>{{ fincode_description($invoice->region_id, $invoice->fin_code) or $invoice->fin_code_desc}}</td>
                  <td>{{ $invoice->total_amount }}</td>
                  <td>{{ $invoice->bill_count }}</td>
                  <td>{{ $invoice->bill_amount }}</td>
                  <td>{{ Invoice::getStatuses()->get($invoice->getStatus()) }}</td>
              </tr>
          @empty
              <td colspan="6" class="center-align">
                  اطلاعات صورتحساب موجود نیست
              </td>
          @endforelse
          </tbody>
      </table>
      <div class="padding">
          <a href="{{ route("profile.invoices.index") }}" class="left">
              گزارش مفصل
              <i class="material-icons text-light" style="color: #039be5">chevron_left</i>
          </a>
          <span class="left"></span>
          <div class="clearfix"></div>
      </div>
  @endcomponent

  @component('components.sheet',['header' =>  '10 پرداخت اخیر'])
      <table>
          <thead>
          <tr>
              <th>کد مالی</th>
              <th>پرداختی</th>
              <th>باقیمانده</th>
          </tr>
          </thead>
          <tbody>
          @forelse($recent_bills as $recent_bill)
              <tr>
                  <td>
                      {{
                        fincode_description($recent_bill->region_id, $recent_bill->fin_code)
                        ??
                        $recent_bill->fin_code_desc
                      }}
                  </td>
                  <td>@currency($recent_bill->payment)</td>
                  <td>@currency($recent_bill->main_balance)</td>
              </tr>
          @empty
              <td colspan="6" class="center-align">
                  اطلاعات پرداختی موجود نیست
              </td>
          @endforelse
          </tbody>
      </table>
      <div class="padding">
          <a href="{{ route("profile.bills.index") }}" class="left">
              گزارش مفصل
              <i class="material-icons text-light" style="color: #039be5">chevron_left</i>
          </a>
          <span class="left"></span>
          <div class="clearfix"></div>
      </div>
  @endcomponent
@endsection
