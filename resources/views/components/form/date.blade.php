<div class="input-field @isset($inline) inline @endisset @isset($invert) invert @endisset" @isset($hidden) hidden @endisset>
  @isset($icon)
    <i class="material-icons prefix">{{ $icon }}</i>
  @endisset
  <input
    @isset($name)
      id="{{ $name }}"
      name="{{ $name }}"
      @if ( $errors->first($name) )
        class="jdateinput invalid {{ isset($class)? $class: '' }}"
      @else
        class = "jdateinput {{ isset($class)? $class: '' }}"
      @endif
    @endisset
    @isset($disabled)
      disabled
    @endisset
    @isset($placeholder)
      placeholder="{{ $placeholder }}"
    @endisset
    @if( isset($type) )
      type="{{ $type }}"
    @else
      type="text"
    @endif
    @isset($value)
      value="{{ $value }}"
    @endisset
    mode =
    @isset($mode)
      "{{ $mode }}"
    @else
      "day"
    @endisset
    @isset($min)
      min = "{{ $min }}"
    @endisset
    @isset($max)
      max = "{{ $max }}"
    @endisset
    @isset($to)
      to = "{{ $to }}"
    @endisset
  >
  @isset($label)
    <label @isset($name) for="{{ $name }}" @endisset @isset($value) class="active" @endisset >{{ $label }}</label>
  @endisset

  @if ( isset($name) && $errors->first($name) )
    <span class="helper-text" data-error="{{ $errors->first($name) }}" ></span>
  @else
    @isset($helper)
      <span class="helper-text" data-error="wrong" data-success="right">{{ $helper }}</span>
    @endisset
  @endif
</div>
