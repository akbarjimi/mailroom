@php
  if(request()->query())
      $query = url()->current() . '?' . http_build_query(request()->except('per_page', 'page')) . '&';
  else
      $query = url()->current() . '?';
@endphp
<span class="padding-left">
  تعداد در صفحه:
  <a class='dropdown-trigger' href='#' data-target='dropdown1'>{{ pdigit($results->perPage()) }}</a>
  <ul id='dropdown1' class='dropdown-content'>
    <li><a href="{{ $query . 'per_page=10' }}">۱۰</a></li>
    <li><a href="{{ $query . 'per_page=15' }}">۱۵</a></li>
    <li><a href="{{ $query . 'per_page=20' }}">۲۰</a></li>
    <li><a href="{{ $query . 'per_page=50' }}">۵۰</a></li>
    <li><a href="{{ $query . 'per_page=100' }}">۱۰۰</a></li>
  </ul>
</span>
{{-- <span class="padding-h"></span> --}}
<span class=" padding-left padding-right ">
  {{ pdigit($results->firstItem()) }} - {{ pdigit($results->lastItem()) }} از {{ pdigit($results->total()) }}
</span>
{{-- <span class="padding-h"></span> --}}
<span class="padding-left"></span>
@if ($results->currentPage() == 1 )
  <i class="material-icons text-light">chevron_right</i>
@else
  <a href="{{ $results->previousPageUrl() }}" class=" padding-right"><i class="material-icons">chevron_right</i></a>
@endif
@if ($results->currentPage() == $results->lastPage() )
  <i class="material-icons text-light">chevron_left</i>
@else
  <a href="{{ $results->nextPageUrl() }}" class=""><i class="material-icons">chevron_left</i></a>
@endif
