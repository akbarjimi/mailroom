  <div @isset($class) class="{{ $class }} input-field form-label" @else class="input-field form-label" @endisset>
  @isset($key) <span class="lable-title">{{ $key }}</span> @endisset
  @isset($value): <span class="label-value">{{ $value }}</span> @endisset
</div>
