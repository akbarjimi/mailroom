<p @isset($class) class="{{ $class }}" @endisset>
    <label>
        <input @isset($name) name="{{ $name }}" @endisset @isset($value) value="{{ $value }}" @endisset type="checkbox"
               @if (isset($checked) && $checked) checked="checked" @endif class="filled-in"
               @if(isset($disabled) && $disabled) disabled @endif/>
        <span>@isset($label){{ $label }}@else &nbsp; @endisset</span>
    </label>
</p>