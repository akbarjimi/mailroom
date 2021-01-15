@extends('admin.layout')
@section('title','انواع نامه')
@section('content')
    @component('components.sheet',[
      'header'    =>  'انواع نامه',
      'medium'    =>  true,
      'tabs'      =>  [
          ['title'    =>  'لیست انواع نامه'],
      ]
    ])
        <div class="padding">
            <i class="material-icons">add</i>
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'افزودن',
                'href'  =>  route('lettertypes.create')
            ])
            @endcomponent

        </div>
        <table>
            <thead>
            <tr>
                <th>ردیف</th>
                <th>کد</th>
                <th>نام</th>
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>
                {{------------------------- End Filters -------------------------}}
                @foreach ($lettertypes as $lettertype)
                    <tr>
                        <td>{{ $loop->iteration + ( ($lettertypes->currentPage()-1) * $lettertypes->perPage() ) }}</td>
                        <td>{{ $lettertype->name }}</td>
                        <td>{{ $lettertype->code }}</td>
                        <td>
                            <a href="{{ route('lettertypes.edit', $lettertype) }}"><i class="material-icons">create</i></a>
                        </td>
                        <td>
                            <a href="{{ route('lettertypes.delete', $lettertype) }}"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="padding">
            <div class="left">
            </div>
            <div class="clearfix"></div>
        </div>
    @endcomponent
@endsection
