@extends('portal.layout')
@section('title','وبلاگ')
@section('content')
<h1 class="title">صفحه اصلی سامانه</h1>
<div class="container">
    <div class="row">
        @foreach($posts as $post)
            <div class="col s4">
                <a href="{{ route('portal.show',['slug' => $post->slug]) }}">
                    <div class="card" style="min-height: 340px;">
                            <div class="card-image waves-effect waves-block waves-light" style="max-height: 250px;">
                                @if(isset($post->image) && $post->image!='')
                                  {{--  @if(file_exists(asset('storage/images/thumbnail/'.$post->image)))--}}
                                        <img class="activator" style="height: 250px;" src="{{asset('storage/images/thumbnails/'.$post->image)}}">
                                   {{-- @else
                                        <img class="activator" src="{{asset('images/tem.jpg')}}">
                                    @endif--}}
                                @else
                                    <img class="activator" src="{{asset('images/tem.jpg')}}">
                                @endif
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">
                                    {{ str_limit($post->title,50,'...') }}
                                </span>
                            </div>
                    </div>
                </a>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>
</div>

@endsection
