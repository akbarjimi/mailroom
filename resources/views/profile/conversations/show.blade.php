@extends('profile.layout')
@section('title','مکاتبه')
@section('content')
    @component('components.sheet',[
      'header'    =>  $conversation->user->fullname. ': ' . $conversation->title,
      'medium'    =>  true,
      'backlink'  =>  route('profile.conversations.index'),
      "extra"     =>  "کد پیگیری :‌ {$conversation->track->id}"
    ])
        <div class="padding conversation-responsive">
            @foreach($conversation->comments()->orderBy("created_at")->get() as $comment)
                <div class="margin-bottom hold">
                    @if($comment->user_id == auth()->id())
                        <div class="padding-h padding-v-half right w-80"
                             style="word-wrap: break-word; border-radius:10px 0 10px 10px; background-color: #2a3498">
                            <div class="caption" style="opacity:.6; color:#fff"> 
                                {{ $comment->user->fullname }}&nbsp
                                {{ jdate($comment->created_at)->format("d F Y - H:i:s") }}
                            </div>
                            <p style="color:#fff; margin:0">{{ $comment->body }}</p>
                            @if($comment->getFirstMedia('comment_attachment'))
                                <div class="caption">
                                    <a href="{{ $comment->getFirstMediaUrl('comment_attachment') }}" download class="w">
                                        <i class="material-icons">file_download</i>
                                        {{ $comment->getFirstMedia('comment_attachment')->file_name }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="back-color padding left w-80" style="word-wrap: break-word; border-radius:0 10px 10px 10px">
                            <div class="caption">
                                {{ $comment->user->fullname }}&nbsp
                                {{ jdate($comment->created_at)->format("d F Y - H:i:s") }}
                            </div>
                            {{ $comment->body }}
                            @if($comment->getFirstMedia('comment_attachment'))
                                <div class="caption">
                                    <a href="{{ $comment->getFirstMediaUrl('comment_attachment') }}" download>
                                        <i class="material-icons">file_download</i>
                                        {{ $comment->getFirstMedia('comment_attachment')->file_name }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @if(!isset($employee))
            @component('components.form',[
              'method'   =>  'POST',
              'action'   =>  route('profile.conversations.comment', $conversation),
              'enctype'  =>  true,
            ])
                <div class="padding">
                    <div></div>
                    <input class="hide file-chip" type="file" id="comment_attachment" name="comment_attachment">
                    @if($conversation->is_open)
                        <div class="input-field col s12" style="display:flex; align-items:center">
                            <textarea name="body" id="icon_prefix2" class="materialize-textarea" value="{{ old('body') }}"></textarea>
                            <label for="icon_prefix2" style="width:96%">متن پیام</label>
                            <a class="tooltipped" data-tooltip="بارگذاری فایل">
                                <i class="material-icons  small click-trigger" clicktarget="#comment_attachment"
                                style="cursor: pointer;" >attach_file</i>
                            </a>
                        </div>
                        @component('components.form.button',[
                          'label' =>  'ارسال پاسخ'
                        ])
                        @endcomponent

                        @component('components.form.button',[
                          'label' =>  'بستن مکاتبه',
                          'flat'  =>  TRUE,
                          'href' => route('profile.conversations.status', $conversation)
                        ])
                        @endcomponent
                    @else
                        <div class="container center" style="border-top: 1px solid lightgray;">
                            <div class="input-field form-label">
                  <span class="label-value">
                    این مکاتبه بسته شده است &nbsp;
                    <a href="{{ route("profile.conversations.status", $conversation) }}">باز کردن</a>
                  </span>
                            </div>
                        </div>
                    @endif
                </div>
            @endcomponent
        @endif
    @endcomponent
@endsection
