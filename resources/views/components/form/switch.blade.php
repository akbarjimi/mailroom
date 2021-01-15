<div class="switch">
  <label>
    @isset($off)
      {{ $off }}
    @endisset
    <input type="checkbox" autosubmit>
    <span class="lever"></span>
      @isset($on)
        {{ $on }}
      @endisset
  </label>
</div>