<div class="input-field @isset($invert) invert @endisset @isset($class) {{$class}} @endisset">
  <select @isset($name) name="{{ $name }}" id="{{ $name }}" @endisset @isset($multiple) multiple @endisset @if($disabled ?? false) disabled @endif >
    @foreach ($options as $key => $value)
       <option @isset($select_item) @if($key==$select_item) selected @endif @endisset value="{{ $key }}">{{ $value }}</option>
    @endforeach
  </select>
  @isset($label)
    <label for="{{ $name }}">{{ $label }}</label>
  @endisset
  @if ( isset($name) && $errors->first($name) )
    <span class="helper-text red-text">{{ $errors->first($name) }}</span>
  @endif
</div>
