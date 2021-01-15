<p @if($inline ?? false) style="display: inline; margin-left: 2rem;" @endif>
  <label>
    <input @isset($name) name="{{ $name }}" @endisset  @isset($value) value="{{ $value }}" @endisset type="radio" @if (isset($checked) && $checked) checked="checked" @endif />
    <span>@isset($label){{ $label }}@else radio @endisset</span>
  </label>
</p>
