<div class="input-field @if ( isset($name) && $errors->first($name) ) error @endif">
  @isset($icon)
    <i class="material-icons prefix">{{ $icon }}</i>
  @endisset
  @isset($label)<strong>{{ $label }}</strong>@endisset
  <textarea
            @isset($name) id="{{ $name }}" name="{{ $name }}" @endisset class="tinymce-full"
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
