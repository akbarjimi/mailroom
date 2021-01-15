<div @isset($id) id={{ $id }} @endisset class="modal">
  @isset($header)
    <div class="modal-header padding">
       <h4 class="headline margin-0">{{ $header }}</h4>
    </div>
  @endisset
  <div class="modal-content">
    {{ $slot }}
  </div>
  <div class="modal-footer">
    @isset($buttons)
      @foreach ($buttons as $button)
        @component('components.form.button', $button)@endcomponent
      @endforeach
    @else
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">انصراف</a>
    @endisset
  </div>
</div>
