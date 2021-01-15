  @php
    $n = str_replace('][', '.', $name) ;
    $n = str_replace('[', '.', $n) ;
    $n = str_replace(']', '', $n) ;
  @endphp
<div class="input-field @isset($inline) inline @endisset @isset($class) {{ $class }} @endisset" @isset($hidden) hidden @endisset>
  @isset($icon)
    <i class="material-icons prefix">{{ $icon }}</i>
  @endisset
  <input
    @isset($autofocus)
      autofocus
    @endisset
    @isset($name)
      id="{{ $name }}"
      name="{{ $name }}"
    @endisset
    class = "{{ (isset($autocomplete) ? 'autocomplete ':'') . (isset($name) && ($errors->first($name) || $errors->first($n)))? 'invalid': ''  }}"
    @if($disabled ?? false)
      disabled
    @endif
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
  >
  @isset($label)
    <label @isset($name) for="{{ $name }}" @endisset @isset($value) class="active" @endisset >{{ $label }}</label>
  @endisset

  @if ( isset($name) && isset($errors) && $errors->first($name) )
    <span class="helper-text" data-error="{{ $errors->first($name) }}" ></span>
  @elseif ( isset($name) && isset($errors) && $errors->first($n) )
    <span class="helper-text" data-error="{{ $errors->first($n) }}" ></span>
  @else
    @isset($helper)
      <span class="helper-text" data-error="wrong" data-success="right">{{ $helper }}</span>
    @endisset
  @endif
</div>
