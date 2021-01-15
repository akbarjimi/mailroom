@extends('profile.layout')
@section('title','فرم های درخواست')
@section('content')
  @component('components.sheet',[
    'header' => 'فرم های درخواست',
    'medium' => true,
    'backlink' => isset($employee)?
                route('admin.users.show', $employee):
                route('profile.index')
  ])
    <div class="">
      {{-- <div class="left">
        {{ $forms->appends(request()->input())->links('components.table-pagination', ['results' => $forms, 'per_page' => true]) }}
      </div> --}}
      <div class="clearfix"></div>
    </div>
    <table>
      <thead>
        <tr>
          <th>عنوان</th>
          <th>فعال</th>
          <th>منطقه</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($forms as $form)
          @component('components.tr',[
            'columns' => [
              $loop->iteration + ( ($forms->currentPage()-1) * $forms->perPage() ),
              $form->title,
              $form->region->name ?? 'استان',
            ],
            'href' => isset($employee)?
              route('admin.users.forms.show', [$employee, $form]):
              route('profile.forms.show', $form)
          ])
          @endcomponent
        @endforeach
      </tbody>
    </table>
    <div class="padding">
      <div class="left">
        {{ $forms->appends(request()->input())->links('components.table-pagination', ['results' => $forms, 'per_page' => true]) }}
      </div>
      <div class="clearfix"></div>
    </div>
  @endcomponent
@endsection
