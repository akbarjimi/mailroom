<div class="title">
  <i class="material-icons secondary-text pointer counter add @if($value >= $max) disable @endif" target="" >add</i>
  <span class="padding-half" max="{{ $max }}" min={{ $min }}>{{ $value }}</span>
  <i class="material-icons secondary-text pointer counter remove @if($value <= $min) disable @endif" target="" >remove</i>
  <input class="{{ $class or '' }}" type="hidden" name="{{ $name or '' }}" value="{{ $value }}" extra= {{ $extra or '' }}>
</div>
