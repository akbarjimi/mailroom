<div class="chip @isset($class){{ $class }}@endisset @if(isset($active)&&$active) active @endif"
     @isset($target) data-target="{{ $target }}" @endisset>
    <a @isset($href) href="{{$href}}" @endisset @isset($disabled) @if($disabled) disabled @endif @endisset>
        @isset($count) <span class="count"> {{ $count }} </span> @endisset
        @isset($label) {{ $label }} @endisset
        @isset($icon)
            <i class="material-icons @if(isset($right))right @elseif(isset($left)) left @endif">{{ $icon }}</i>
        @endisset
    </a>
</div>
