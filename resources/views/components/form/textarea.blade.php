<div class="input-field @if ( isset($name) && $errors->first($name) ) error @endif">
  @isset($icon)
    <i class="material-icons prefix">{{ $icon }}</i>
  @endisset

  @isset($label)
      <label @isset($name) for="{{ $name }}" @endisset @isset($value) class="active" @endisset >{{ $label }}</label>
  @endisset
  <textarea
            @isset($name) id="{{ $name }}" name="{{ $name }}" @endisset
            @isset($class_name)  class="materialize-textarea {{ $class_name }}" @else class="materialize-textarea" @endisset
            rows="7"
  >@isset($value){!! $value !!}@endisset</textarea>

  @if ( isset($name) && $errors->first($name) )
      <span class="helper-text" data-error="" >{{ $errors->first($name) }}</span>
  @else
      @isset($helper)
          <span class="helper-text" data-error="wrong" data-success="right">{{ $helper }}</span>
      @endisset
  @endif
</div>
