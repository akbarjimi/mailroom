@extends('admin.layout')
@section('title','کاربران')
@section('content')
    @component('components.sheet',[
      'header'    =>  'کاربران',
      'medium'    =>  true,
      'tabs'      =>  [
          ['title'    =>  'لیست کاربران'],
      ]
    ])
        <div class="padding">
            <i class="material-icons">add</i>
            @component('components.chip',[
                'active' => true,
                'class' => 'info',
                'label' => 'افزودن',
                'href'  =>  route('users.create')
            ])
            @endcomponent

        </div>
        <table>
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>ویرایش</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>
                {{------------------------- End Filters -------------------------}}
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + ( ($users->currentPage()-1) * $users->perPage() ) }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->family }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user) }}"><i class="material-icons">create</i></a>
                        </td>
                        <td>
                            <a href="{{ route('users.delete', $user) }}"><i class="material-icons">delete</i></a>
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
