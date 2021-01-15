<div class="sheet @isset($medium) medium @endisset z-depth-3">
  @isset($header)
    <div class="left padding blue-text h1">
        @isset($extra)
            {{ $extra }}
        @endisset
    </div>
    <div class="header">
      <h1>
        @if(isset($backlink))
          <a href=" {{ $backlink }}"><i class="material-icons">arrow_forward</i></a>
        @endif
        {{ $header }}
      </h1>
      @isset($description)
        {{ $description }}
      @endisset
      @isset($tabs)
        <ul class="sheet-tab hold">
          @foreach ($tabs as $tab)
            @if( !isset($tab['render']) || ( isset($tab['render']) && $tab['render'] ) )
              <li @isset($tab['link']) @else class="active" @endisset>
                <a @isset($tab['link']) href="{{ $tab['link'] }}" @endisset>{{ $tab['title'] }}</a>
              </li>
            @endif
          @endforeach
        </ul>
      @endisset
    </div>
  @endisset
  @isset($padding)
    <div class="padding">
      {{ $slot }}
    </div>
  @else
    {{ $slot }}
  @endisset
</div>
