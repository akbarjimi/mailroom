@extends('profile.layout')
@section('title','آموزشگاه ها')
@section('content')
    @component('components.sheet', [
      'header' => 'آموزشگاه ها',
    ])
        <div class="padding">
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'راهنمای تولید صورتجلسه سال تحصیلی جاری',
                'href'  =>  url('storage/student_insurance_guide.mp4')
            ])
            @endcomponent
        </div>    
        <table>
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>کد</th>
                <th>منطقه</th>
                <th>ظرفیت</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($schools as $school)
                @component('components.tr',[
                    'columns' => [
                      $loop->iteration,
                      $school->name,
                      $school->school_code,
                      $school->region->name,
                      $school->capacity . " نفر",
                  ],
                  'href'    =>  route('profile.schools.show', $school),
                ])
                @endcomponent
            @empty
            <td colspan="10" class="center-align">
                در سال جدید تحصیلی، آموزشگاه‌ها معرفی نشده‌اند.
            </td>
            @endforelse
            </tbody>
        </table>
    @endcomponent
@endsection
