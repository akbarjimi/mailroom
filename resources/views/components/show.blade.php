<div class="row">
  @foreach ($items as $item)
    <div class="col @isset($item['big']) s12 @else s12 m6 @endisset @isset($item['class']) {{ $item['class'] }} @endisset" >
      <strong>{{ $item['label'] }}:</strong>
        <span>
            @isset($item['link']) <a href="{{ $item['link'] }}"> @endisset
                {!! $item['value'] !!}
                @isset($item['link']) </a> @endisset
        </span>
    </div>
  @endforeach
</div>
