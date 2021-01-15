<ul @isset($id) id="{{ $id }}" @endisset class='dropdown-content'>
  @isset($items)
    @foreach ($items as $item)
      <li @isset($item['class']) class="{{ $item['class'] }}" @endisset >
        <a href="@isset($item['href']){{ $item['href'] }}@endisset">
          @isset($item['icon'])<i class="material-icons">{{ $item['icon'] }}</i>@endisset
          @isset($item['label']) {{ $item['label'] }} @endisset
        </a>
      </li>
    @endforeach
  @endisset
</ul>
