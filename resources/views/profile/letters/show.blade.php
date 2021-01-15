@extends('profile.layout')
@section('title','معرفی نامه های من')
@section('content')


  @if ($letter->form->itNeedAttachments())
      @php
        if ($letter->isAllFilesAttached()) {
          if ($letter->form->validation) {
            if ($letter->is_valid) {
              $string = 'فرم شما با موفقیت ثبت شد.';
            } else {
              $string = 'فرم شما تکمیل گردید، منتظر تایید مدیریت باشید.';
            }            
          } else {
            if ($letter->is_valid) {
              $string = 'فرم شما با موفقیت ثبت شد.';              
            } else {
              $string = 'در صورت تایید صحت اطلاعات، دکمه ثبت نهایی را بزنید.';
            }
          }
        } else {
          $string = 'برای تکمیل فرم، ضمیمه کردن فایل‌های زیر الزامی است';
        }
    @endphp
    @component('components.sheet', [
      'header' => $string,
      'medium' => true,
    ])
    @endcomponent
  @endif


  {{-- If the letter does not require an attachment, then the result of such a function will be negative --}}
  {{-- The letter must be approved by management for display to the end user. This confirmation can be public or granted by management. --}}
  @if(($letter->form->itNeedAttachments() === $letter->isAllFilesAttached()) && ($letter->form->validation || $letter->is_valid))
    @component('components.sheet',[
      'header' => 'معرفی نامه ' . $letter->title,
      'backlink' => isset($employee) ? route('admin.users.letters.index', $employee) : route('profile.letters.index'),
      'medium' => true,
      'padding' => true
    ])
      {!! html_entity_decode($letter->body) !!}
      <br>
      <br>
      <div class="row">
        <div class="col s2">
          @if ($letter->is_valid)
            @if ($letter->form->itNeedAttachments())
                @if ($letter->isAllFilesAttached())
                  @component('components.form.button',[
                    'href' => isset($employee)?
                    route('admin.users.letters.print', [$employee, $letter]):
                    route('profile.letters.print', $letter),
                    'label' => 'چاپ'
                  ])
                  @endcomponent
                @endif
            @else
              @component('components.form.button',[
                'href' => isset($employee)?
                route('admin.users.letters.print', [$employee, $letter]):
                route('profile.letters.print', $letter),
                'label' => 'چاپ'
              ])
              @endcomponent          
            @endif
          @endif
        </div>
        @access('forms')
        @isset($employee)
          @if(Auth::user()->accesses('forms', true))
          <div class="col s2">
            @component('components.form', [
              'method' => 'DELETE',
              'action' => route('admin.users.letters.destroy', [$employee, $letter]),
            ])
              @component('components.form.button',[
                'label' => 'حذف',
                'class' => 'danger',
              ])
              @endcomponent
            @endcomponent
          </div>        
          @endif
        @else
        <div class="col s2">
          @component('components.form', [
            'method' => 'DELETE',
            'action' => route('profile.letters.destroy', $letter),
          ])
            @component('components.form.button',[
              'label' => 'حذف',
            ])
            @endcomponent
          @endcomponent
        </div>
        @endisset
        @endaccess
      </div>             
    @endcomponent
  @endif

  @if($letter->form->itNeedAttachments())
    @component('components.sheet',[
      'header' =>  'فایل‌های ضمیمه مورد نیاز',
      'medium' => true,
    ])
            <div class="col s2 padding">
              @if ($letter->form->itNeedAttachments() && $letter->isAllFilesAttached() === false)
                <i class="material-icons">add</i>
                @component('components.form.button',[
                  'href' => route('letters.attachments.create', $letter),
                  'label' => 'افزودن  '.$letter->form->attachments[$letter->nextAttachment()],
                ])
                @endcomponent              
              @endif

              @if ($letter->isAllFilesAttached())
                @component('components.form.button',[
                  'href' => route('letters.attachments.zipped', $letter),
                  'label' => 'دانلود یکجا'
                ])
                @endcomponent
              @endif

              @if ($letter->isAllFilesAttached() && $letter->is_valid == false && $letter->form->validation == false)
                @component('components.form.button',[
                  'href' => route('letters.attachments.confirmed', $letter),
                  'label' => 'ثبت نهایی'
                ])
                @endcomponent                  
              @endif
          </div>
        <table>
            <thead>
              <tr>
                  <th>نام</th>
                  <th>دانلود</th>
                  <th>حذف</th>
              </tr>
            </thead>
            <tbody>

            @forelse($letter->getMedia('letter_attachments') as $attachment)
                <tr>
                  <td>
                    {{ $attachment->getCustomProperty('name') }}
                  </td>

                  <td>
                    <a href="{{ route('letters.attachments.download', [$letter, $attachment]) }}">
                      <i class="material-icons right ">file_download</i>
                    </a>
                  </td>

                  <td>
                    @unless($letter->is_valid)
                      <a href="#" onclick='event.preventDefault(); document.getElementById("delete_media_{{ $attachment->id }}").submit()'>
                        <i class="material-icons right ">delete</i>
                      </a>                  
                      <form action="{{ route('letters.attachments.destroy', [$letter, $attachment]) }}" method="POST" id="delete_media_{{ $attachment->id }}">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                      </form>                        
                    @endunless
                  </td>

                </tr>
            @empty
                <td colspan="6" class="center-align">
                    فایل ضمیمه‌ای یافت نشد.
                </td>
            @endforelse
            </tbody>
          </table>
    @endcomponent
  @endif
@endsection
