@extends('admin.layout')
@section('title','انواع نامه')
@section('content')
    @component('components.sheet',[
      'header'    =>  'انواع نامه',
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
                'href'  =>  route('letters.create')
            ])
            @endcomponent

        </div>
        <table>
            <thead>
            <tr>
                <th>ردیف</th>
                <th>شماره نامه</th>
                <th>تاریخ</th>
                <th>نوع نامه</th>
                <th>مربوط به پروژه</th>
                <th>موضوع</th>
                <th>تهیه کننده</th>
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>
                {{------------------------- End Filters -------------------------}}
                @foreach ($letters as $letter)
                    <tr>
                        <td>{{ $loop->iteration + ( ($letters->currentPage()-1) * $letters->perPage() ) }}</td>
                        <td>{{ "{$letter->row}/{$letter->lettertype->code}/{$letter->project_id}" }}</td>
                        <td>{{ $letter->date->format("Y-m-d") }}</td>
                        <td>{{ $letter->lettertype->name }}</td>
                        <td>{{ $letter->project->name }}</td>
                        <td>{{ $letter->title }}</td>
                        <td>{{ $letter?->user?->name }}</td>
                        <td>
                            <a href="{{ route('letters.edit', $letter->id) }}"><i class="material-icons">create</i></a>
                        </td>
                        <td>
                            <a href="{{ route('letters.delete', $letter->id) }}"><i class="material-icons">delete</i></a>
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
