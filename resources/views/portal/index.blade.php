@extends('portal.layout')
@section('title','صفحه اصلی')
@section('content')
  @isset($swiper_posts)
    <div class="swiper-container margin-bottom z-depth-1 white radius">
      <div class="swiper-wrapper">
        @foreach ($swiper_posts as $swiper_post)
          <div class="swiper-slide">
            <a href="{{ route('blog.post', $swiper_post) }}">
              @if ($swiper_post->getMedia('post-banner')->count())
                <img src="{{ $swiper_post->getFirstMediaUrl('post-banner', 'banner') }}" alt="">
              @else
                <img src="/images/post/banner.jpg" alt="{{ $swiper_post->title }}">
              @endif
              <div class="padding">
                <h1 class="title margin-0 text-color">{{ $swiper_post->title }}</h1>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  @endisset
  {{-- @component('components.form', [
    'action' => route('blog.search'),
  ])
    @component('components.form.text', [
      'name' => 'search',
      'placeholder' => 'جستجو در مطالب',
      'value' => request()->input('search')
    ])
    @endcomponent
  @endcomponent --}}
  <div class="hold">
    @foreach ($posts as $post)
      @component('components.post-card',[
        'post' => $post
      ])
      @endcomponent
    @endforeach
  </div>
  {{ $posts->links() }}
@endsection
@section('sidebar')
  <img src="/images/side1.png" class="margin-bottom z-depth-1 radius" >
@endsection
