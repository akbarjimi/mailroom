<table>
  @isset($horizontal)
  @else
    <thead>
      <tr>
        @isset($index)
          <th>#</th>
        @endisset
        @foreach ($columns as $column)
          <th>{{ $column['title'] }}</th>
        @endforeach
      </tr>
    </thead>
  @endisset
  <tbody>
    @isset($horizontal)
      @foreach ($columns as $column)
        <tr>
          <th>{{ $column['title'] }}</th>
          @foreach ($data as $item_index => $item)
            <td>{{ $item[$column['field']] }}</td>
          @endforeach
        </tr>
      @endforeach
    @else
      @foreach ($data as $item_index => $item)
        <tr>
          @isset($index)
            <td>{{ $index }}</td>
          @endisset
          @foreach ($columns as $column)
            <td>
              @isset($item[$column['field']])
                @if(isset($column['link']))
                  @if(isset($column['link_parm']))
                    @php
                      $link_parm = [];
                      foreach ($column['link_parm'] as $key => $param)
                      $link_parm[$key] = $item[$param]
                    @endphp
                    <a href="{{ route($column['link'], $link_parm ) }}">{{ $item[$column['field']] }}</a>
                  @else
                    <a href="{{ route($column['link']) }}">{{ $item[$column['field']] }}</a>
                  @endif
                @else
                  {{ $item[$column['field']] }}
                @endif
              @endisset
            </td>
          @endforeach
        </tr>
      @endforeach
    @endisset
  </tbody>
</table>
