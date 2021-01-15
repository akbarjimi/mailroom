@extends('profile.layout')
@section('content')
  @component('components.sheet',[
    'padding' => true
  ])
    <div>{{ $hotel->name }}</div>
    <div>{{ $user->name}} {{ $user->family }}</div>
    <div>{{ $reserve['start'] }}</div>
    <div>{{ $reserve['finish'] }}</div>
  @endcomponent
    @foreach ($reserve['roomtypes'] as $roomtype_id => $roomtype_reserve)
      @php $roomtype = $hotel->roomtypes->keyBy('id')[$roomtype_id] @endphp
      @for ($i=0; $i < $roomtype_reserve['count']; $i++)
        @component('components.sheet',[
          'header' => $roomtype->name
        ])
          <table>
            <thead>
              <tr>
                <th>خدمت</th>
                <th>شرح</th>
                <th>قیمت واحد</th>
                <th>قیمت کل</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $roomtype->name }}</td>
                <td></td>
                <td>{{ $roomtype->price }}</td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        @endcomponent
      @endfor
    @endforeach
@endsection
