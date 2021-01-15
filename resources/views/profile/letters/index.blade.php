@extends('profile.layout')
@section('title','معرفی نامه های من')
@section('content')
  @component('components.sheet',[
    'header' => 'معرفی نامه ها',
    'medium' => true,
    'backlink' => isset($employee)?
                route('admin.users.show', $employee):
                route('profile.index')
  ])
    <div class="padding">
      <i class="material-icons" >add</i>
      @component('components.chip',[
          'active'=> true,
          'class' => 'info',
          'label' => 'درخواست جدید',
          'href'  => isset($employee)?
                route('admin.users.forms.index', $employee):
                route('profile.forms.index')
      ])
      @endcomponent
      <div class="clearfix"></div>
    </div>
    <table>
      <thead>
        <tr>
          <th>عنوان</th>
          <th>تاریخ صدور</th>
          <th>اعتبار سنجی</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($letters as $letter)
          @component('components.tr', [
            'columns' => [
              $letter->form->title,
              jdate($letter->created_at)->format('d F Y ساعت H:i'),
              [1 => 'تایید شده', null => 'در انتظار تایید', 0 => 'تایید نشده'][$letter->is_valid],
            ],
            'href' => isset($employee)?
                route('admin.users.letters.show', [$employee, $letter]):
                route('profile.letters.show', $letter)
          ])
          @endcomponent
        @endforeach
      </tbody>
    </table>
    <div class="padding">
      <div class="left">
        {{ $letters->appends(request()->input())->links('components.table-pagination', ['results' => $letters, 'per_page' => true]) }}
      </div>
      <div class="clearfix"></div>
    </div>
  @endcomponent
@endsection
