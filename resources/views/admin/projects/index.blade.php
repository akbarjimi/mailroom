@extends('admin.layout')
@section('title','انواع پروژه')
@section('content')
    @component('components.sheet',[
      'header'    =>  'انواع پروژه',
      'medium'    =>  true,
      'tabs'      =>  [
          ['title'    =>  'لیست انواع پروژه'],
      ]
    ])
        <div class="padding">
            <i class="material-icons">add</i>
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'افزودن',
                'href'  =>  route('projects.create')
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
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration + ( ($projects->currentPage()-1) * $projects->perPage() ) }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->code }}</td>
                        <td>
                            <a href="{{ route('projects.edit', $project) }}"><i class="material-icons">create</i></a>
                        </td>
                        <td>
                            <a href="{{ route('projects.delete', $project) }}"><i class="material-icons">delete</i></a>
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
