<div>
    {{ $insurer_company ?? str_repeat('.',100)  }}
    <div>
        <p>
            با سلام؛
            عطف به قرارداد شماره {{ $contract_number ?? str_repeat('.',100)  }} بیمه حوادث و درمان دانش آموزان و کارکنان
            وزارت آموزش
            و پرورش (سال
            تحصیلی {{ academic_year(true) }})
            بدینوسیله مدارک
            @foreach($documents as $id => $label)
                @continue(!in_array($id, $selected_documents))
                    <span id="change_font">
                            &#x2611;
                    </span>
                    <strong>{{ $label }}</strong>
            @endforeach
            خانم/آقای
            {{ $insured->fullname }}
            <strong>فرزند</strong>
            {{ $insured->father }}
            <strong>کد ملی</strong>
            {{ $insured->national_id }}
            <strong>از</strong>
            {{ str_replace('حوادث','', Insured::types()->get($insured->insurance_type)) }}
            @if ($insured->school->name)
                <strong>آموزشگاه</strong>
                {{ $insured->school->name }}
            @endif
            <strong>منطقه</strong>
            {{ $insured->region->name }}
            آموزش پرورش شهرستان‌های استان تهران جهت بررسی پرداخت خسارت نامبرده ارسال میگردد.
        </p>
    </div>
    <strong>
        شرح مختصری از حادثه :
    </strong>
    <br>
    <br>
    بدینوسیله اعلام میدارد
    <strong>خانم/آقای</strong>
    {{ $insured->fullname }}
    در تاریخ {{ $date }} {!! $description !!}
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <td colspan="2" class="center">
                    اطلاعات حساب بیمه شده
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>
                    بانک عامل
                </th>
                <td>
                    {{ $bank ?? str_repeat('.', 100)}}                    
                </td>
            </tr>            
            <tr>
                <th>
                    شماره حساب
                </th>
                <td>
                    {{ $bank_account ?? str_repeat('.',100) }}
                </td>
            </tr>
            <tr>
                <th>
                    صاحب حساب
                </th>
                <td>
                    {{ $bank_account_owner ?? str_repeat('.',100) }}
                </td>
            </tr>
            @isset($bank_account_owner_relation)
            <tr>
                <th>
                        نسبت صاحب حساب با بیمه شده
                </th>
                <td>
                        {{ $bank_account_owner_relation }}
                </td>
            </tr>
            @endisset
            @isset($total_costs)
                <tr>
                    <th>
                            کل مبلغ هزینه اعلام شده                        
                    </th>
                    <td>
                            {{ number_format($total_costs) ?? str_repeat('.',100) }} ریال
                            معادل
                            {{ (new convertDigitsToWords())->numberToWords($total_costs) }} ریال                        
                    </td>
                </tr>
            @endisset
            @if (in_array($insured->type, [Insured::REFUGEES, Insured::STUDENTS_EVENTS])))
            <tr>
                    <th>
                        نام و نام خانوادگی ولی یا قیم بیمه شده
                    </th>
                    <td>
                        {{ $father_or_who_has_custody ?? str_repeat('.',100) }}                                        
                    </td>
            </tr>                
            @endif
            @if (isset($mobile) || isset($tel))
            <tr>
                    <th>
                        اطلاعات تماس
                    </th>
                    <td>
                        @if ($mobile)
                             تلفن همراه :
                            {{ $mobile }}
                        @endif
    
                        @if ($tel)
                            تلفن ثابت :
                            {{ $tel }}
                        @endif
                    </td>
                </tr>                
            @endif
        </tbody>
    </table>
</div>
<p style="padding-right: 50%">
    @if(Auth::user()->accesses('users', true))
    اداره کل آموزش و پرورش شهرستانهای استان تهران
    @elseif(!empty(Auth::user()->accesses('users')))
        مسئول تعاون منطقه : {{ $school->region->name }}
    @elseif(Auth::user()->schools->isNotEmpty())
        مدیریت آموزشگاه : {{ $school->name }}
    @endif
    <br>
    <span style="padding-right: 40%">مهر و امضا</span>    
</p>
    
    @if(in_array("medical", $selected_documents) ?? in_array("operation", $selected_documents))
    <table>
        <thead>
            <tr>
                <td>
                    مدارک لازم جهت پرداخت هزینه پزشکی                
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>
                        ۱. اصل یا تصویر برابر اصل شده گزارش حادثه توسط مراجع ذیصلاح
                        ۲. در صورت انجام اعمال جراحی بیمارستانی اصل صورتحسابهای بیمارستانی به همراه ریز داروها و لوازم مصرفی، فاکتورهای
                        انجام آزمایش و رادیولوژی و ...
                        ۳. در صورت استفاده از اداره کل‌های بیمه‌ای تصویر صورتحساب‌ها به همراه تصویر چک دریافتی از اداره کل‌های مذکور
                        ۴. گواهی پزشک معالج مبنی بر نوع عمل و میزان حق العمل دریافتی و گواهی پزشک بیهوشی
                        ۵. تصویر صفحه اول شناسنامه بیمه شده
                        ۶. در صورت معالجه سرپایی گواهی پزشک مبنی بر اعمال انجام شده و وسایل مصرفی، فاکتورهای انجام آزمایش و رادیولوژی،
                        نسخ داروهای مصرفی ممهور به مهر داروخانه و ...
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    @endif
    <br>
    @if(in_array("maim", $selected_documents))
    <table>
        <thead>
            <tr>
                <td>
                    مدارک جهت پرداخت خسارت نقص عضو
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>
                        ۱. اصل یا تصویر برابر اصل شده گزارش حادثه توسط مراجع ذیصلاح
                        ۲. اصل یا تصویر برابر اصل شده گزارش اولین مرجع درمانی و مدارک بیمارستانی (شرح عمل و ...)
                        ۳. عکس‌های رادیوگرافی انجام شده از عضو حادثه دیده بنا به نوع حادثه و در صورت نیاز
                        ۴. گواهی پزشک معالج مبنی بر اتمام معالجات و ایجاد نقص عضو
                        ۵. تصویر صفحه اول شناسنامه بیمه شده
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    @endif
    <br>
    @if(in_array("passed_away", $selected_documents))
    <table>
        <thead>
            <tr>
                <td>
                    مدارک لازم جهت پرداخت غرامت فوت
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>
                        ۱. اصل یا تصویر برابر اصل شده گزارش حادثه توسط مراجع ذیصلاح
                        ۲. اصل یا تصویر برابر اصل شده خلاصه رونوشت وفات
                        ۳. اصل یا تصویر برابر اصل شده گواهی فوت پزشکی قانونی و جواز دفن
                        ۴. اصل یا تصویر برابر اصل شده صفحات شناسنامه باطل متوفی
                        ۵. تصویر صفحه اول شناسنامه بیمه شده و وراث
                        ۶. اصل یا تصویر برابر اصل شده گواهی انحصار وراثت بیمه شده
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    @endif    