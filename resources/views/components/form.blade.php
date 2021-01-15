<form @isset($action) action="{{$action}}" @endisset  @isset($method) method="POST"
      @endisset @isset($enctype) enctype="multipart/form-data" @endisset @isset($id) id="{{ $id }}" name="{{ $id }}"
      @endisset autocomplete="off">
  @isset($header)
    <h1>{{ $header }}</h1>
  @endisset
  @isset($method) {{ csrf_field() }} @endisset
  @isset($method) {{ method_field($method) }} @endisset
  {{ $slot }}
</form>
