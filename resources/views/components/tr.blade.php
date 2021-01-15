<tr @isset($class) class="{{ $class }}" @endisset>
  @isset($checkbox)
    <td> @component('components.form.checkbox',['name'  =>  $checkbox]) @endcomponent</td>
  @endisset
  @isset($href)
    @foreach ($columns as $column)
      <td><a href="{{ $href }}">{{ $column }}</a></td>
    @endforeach
  @else
    @foreach ($columns as $column)
      <td>{{ $column }}</td>
    @endforeach
  @endisset
  @isset($menu)
    <td>
      <a class="action left dropdown-trigger" data-target="{{ $menu_id }}" href="#"><i class="material-icons">more_vert</i></a>
      @component('components.dropdown', [ 'id' => $menu_id, 'items' => $menu ])@endcomponent
    </td>
  @endisset
</tr>
