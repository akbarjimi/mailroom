@if (isset($href))
  <a @isset($target) target="{{$target}}" @endisset  @isset($name) id="{{$name}}" @endisset href="{{$href}}" class="waves-effect @if(isset($flat))waves-grey btn-flat @else waves-light btn @endif @isset($disabled) @if($disabled) disabled @endif @endisset @isset($class) {{ $class }} @endisset">
    @isset($icon)
      <i class="material-icons @if(isset($right))right @elseif(isset($left)) left @endif">{{ $icon }}</i>
    @endisset
      @isset($label) {{$label}} @else ارسال @endisset
  </a>
@else
  <button class="@if(isset($flat))btn-flat @else btn @endif waves-effect waves-light @isset($disabled) @if($disabled) disabled @endif @endisset @isset($class) {{ $class }} @endisset"
          type="{{ $type || "submit" }}"
          @isset($name) id="{{$name}}" name="{{$name}}"@endisset
          @isset($action) formaction="{{$action}}" @endisset
  >
    @isset($label) {{$label}} @else ارسال @endisset
    @isset($icon)
      <i class="material-icons @if(isset($right))right @elseif(isset($left)) left @endif">{{ $icon }}</i>
    @endisset
  </button>
@endif
