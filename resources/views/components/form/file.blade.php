<div class="file-field input-field">
  <div class="btn">
    <span>@isset($label) {{ $label }} @else فایل @endisset</span>
    <input  type="file" @isset($name) name="{{ $name }}" @endisset @isset($multiple) multiple  @endisset>
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate @if ( $errors->first($name) ) invalid @endif" type="text">
    @if ( isset($name) && $errors->first($name) )
      <span class="helper-text" data-error="{{ $errors->first($name) }}"></span>
    @endif
  </div>
</div>
