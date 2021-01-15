@extends('portal.layout')
@section('title',$post->title)
@section('content')
  <div class="white z-depth-1">
    @if ($post->getMedia('post-banner')->count())
      <img src="{{ $post->getFirstMediaUrl('post-banner', 'banner') }}" alt="">
    @else
      <img src="/images/post/banner.jpg" alt="{{ $post->title }}">
    @endif
    
    <div class="container large">
      <br>
      <div>
        <h1 class="headline margin-0">{{ $post->title }}</h1>
        <div class="padding-v">
          <a href="{{ route('blog.region', ['region' => $post->region]) }}"><i class="material-icons">place</i>{{ $post->region->name }}</a>
          <div class="left caption">
            {{ jdate($post->created_at)->format('l j F Y') }}
          </div>
        </div>
      </div>
      
      
      @foreach ($post->categories()->group('post')->get() as $category)
        <a href="{{ route('blog.category', ['category' => $category]) }}">{{ $category->name }}</a>
      @endforeach
      {{ strip_tags(html_entity_decode($post->body)) }}
      <br><br><br>
    </div>
  </div>
  <br><br>
@endsection
@section('sidebar')
  <img src="/images/side1.png" class="margin-bottom z-depth-2" >
@endsection
