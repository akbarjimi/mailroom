<style>
    table, th, tr, td {
        border: 2px solid black;
    }

    table {
        border-collapse: collapse;
    }

    table.rtl {
        direction: rtl
    }
</style>
@if(in_array($insured->insurance_type, [Insured::REFUGEES, Insured::STUDENTS_EVENTS]))
    <table>
        <thead>
        <tr>
            <th>نام و نام خانوادگی دانش آموز</th>
            <th>کد ملی</th>
            <th>منطقه محل تحصیل و مقطع تحصیلی</th>
            <th>شماره حساب</th>
            <th>شماره تماس</th>
            <th>نام و نام خانوادگی صاحب حساب</th>
            <th>نسبت صاحب حساب با بیمار</th>
            <th>نوع بیماری</th>
            <th>سابقه بیماری (مدت بر حسب سال)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $insured->fullname }}</td>
            <td>{{ $insured->national_id }}</td>
            <td>{{ $insured->region->name }} - {{ $school->name }}</td>
            <td>{{ $bank_account }}</td>
            <td>{{ $tel }}</td>
            <td>{{ $bank_account_owner }}</td>
            <td>{{ $bank_account_owner_relation }}</td>
            <td>{{ $sickness }}</td>
            <td>{{ $sickness_duration }}</td>
        </tr>
        </tbody>
    </table>
@endif

@if(in_array($insured->insurance_type, [Insured::STAFFS_EVENTS, Insured::STAFFS_FAMILY_EVENTS]))
    <table>
        <thead>
        <tr>
            <th>نام و نام خانوادگی همکار</th>
            <th>کد ملی</th>
            <th>محل خدمت</th>
            <th>شماره حساب (صرفا بانک ملی)</th>
            <th>شماره تماس</th>
            <th>نسبت</th>
            <th>نام و نام خانوادگی بیمار</th>
            <th>کد ملی بیمار</th>
            <th>نوع بیماری</th>
            <th>سابقه بیماری (مدت بر حسب سال)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $insured->fullname }}</td>
            <td>{{ $insured->national_id }}</td>
            <td>{{ $insured->region->name }} - {{ $school->name }}</td>
            <td>{{ $bank_account }}</td>
            <td>{{ $tel }}</td>
            <td>{{ Insured::mainOrSub()->get($relation) }}</td>
            @if($relation == Insured::SUB)
                <td>{{ $patient_full_name }}</td>
                <td>{{ $patient_national_id }}</td>
            @else
                <td>{{ $insured->fullname }}</td>
                <td>{{ $insured->national_id }}</td>
            @endif
            <td>{{ $sickness }}</td>
            <td>{{ $sickness_duration }}</td>
        </tr>
        </tbody>
    </table>
@endif

<table>
    <thead>
    <tr>
        <th>مبلغ کل هزینه های ارایه شده</th>
        <th>مبلغ دریافتی از بیمه‌گر اول</th>
        <th>مبلغ دریافتی از بیمه‌گر مکمل</th>
        <th>جمع کل هزینه‌های پرداخت شده با توجه به مدارک ارایه شده</th>
        <th>نوع مساعدت منطقه</th>
        <th>مبلغ</th>
        <th>توضیحات</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $total_costs }}</td>
        <td>{{ $amount_received_from_first_insurer }}</td>
        <td>{{ $amount_received_from_supplementary_insurer }}</td>
        <td>{{ $total_costs - $amount_received_from_first_insurer - $amount_received_from_supplementary_insurer }}</td>
        <td> -</td>
        <td> -</td>
        <td> -</td>
    </tr>
    </tbody>
</table>
<table style="border: 1px solid green">
    <thead>
    <tr>
        <th>مدارک مورد نیاز</th>
        <th>ملاحظات</th>
        <th>نظریه کمیسیون</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>نامه منطقه</td>
        <td>در صورتیکه مدارک هزینه درمان کپی باشد، ارایه مدارک پرداخت بیمه تکمیلی و بیمه پایه الزامی است.</td>
        <td>مساعدت مالی به مبلغ ... ریال</td>
    </tr>
    <tr>
        <td>تکمیل معرفی نامه به صورت کامل</td>
        <td colspan="2">در صورتیکه حساب معرفی شده به غیر از حساب ملی باشدپ ارائه حساب شبا الزامی است.</td>
    </tr>
    <tr>
        <td>کپی فیش حقوقی همکار</td>
        <td>حساب معرفی شده جهت دانش آموز می بایست به نام خود دانش آموز یا پدر ایشان باشد، در غیر این صورت ارائه مدارک
            کفالت الزامی میباشد.
        </td>
        <td>اختصاص وام قرض الحسنه</td>
    </tr>
    <tr>
        <td>کپی کارت ملی همکار و بیمار</td>
        <td>علت عدم موافقت</td>
    </tr>
    <tr>
        <td>کپی صفحه اول دفترچه بیمه همکار و بیمار</td>
        <td>موارد مربوط به هزینه های ارائه شده به طور کامل و دقیق تکمیل گردد.</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>مهر و امضا کارشناس مسئول تعاون منطقه</td>
        <td>کارشناسی امور رفاهی استان</td>
        <td>کارشناس مسئول امور رفاهی استان</td>
        <td>رئیس اداره تعاون و امور رفاهی</td>
    </tr>
    </tbody>
</table>
