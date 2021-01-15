<div class="post-hcard white padding col s12 padding-right-0 padding-left-0 margin-bottom z-depth-1 relative radius">
  <div class="col m4 s12 padding-right-0 relative">
    <a href="{{ route($route ?? 'blog.post', $post) }}">
      @if ($post->getMedia('post-banner')->count())
        <img class="hide-on-small-only" src="{{ $post->getFirstMediaUrl('post-banner', 'thumb') }}" alt="{{ $post->title }}">
        <img class="hide-on-med-and-up" src="{{ $post->getFirstMediaUrl('post-banner', 'teaser') }}" alt="{{ $post->title }}">
      @else
        <img class="hide-on-small-only" src="/images/post/teaser.jpg" alt="{{ $post->title }}">
        <img class="hide-on-med-and-up" src="/images/post/lteaser.jpg" alt="{{ $post->title }}">
      @endif
      {{-- <img class="activator" style="height: auto; width: 100%;" src="{{ $post->getFirstMediaUrl('post-banner', 'thumb') }}"> --}}
      {{-- <img class="hide-on-med-and-up" src="{{ isset($post->image)? asset( 'storage/images/banner/'.$post->image): asset('images/hotel-banner.jpg') }}"> --}}
      {{-- <img class="hide-on-small-only" src="{{ isset($post->image)? asset( 'storage/images/teaser/'.$post->image): asset('images/hotel-teaser.jpg') }}"> --}}
    </a>
    @php $cat = $post->categories()->group('post_cat')->first(); @endphp
    @if($cat)
      <a class="abs-top-right secondary padding-h white-text z-depth-2" href="/category/{{ $cat->id }}">{{ $cat->name }}</a>
    @endif
  </div>
  <div class="col m8 s12 padding-v padding-left relative">
    <h2 class="margin-0 title">
      <a class="text-color" href="{{ route($route ?? 'blog.post', $post) }}">{{ $post->title }}</a>
    </h2>
    {{-- <div class="margin-0">{{ strip_tags($post->abstract) }}</div> --}}
    <div class="margin-0">{{ str_limit(strip_tags(html_entity_decode($post->abstract)), 170, ' ...') }}</div>
  </div>
  <div class="col m8 s12">
    <div class="padding"></div>
  </div>
  <div class="col m8 s12 padding-bottom padding-left relative abs-bottom-left">
    <div class="left caption">
      {{ jdate($post->created_at)->format('l j F Y') }}
    </div>
    <a href="/region/{{ $post->region->id }}" class="abs-bottom-rightx">
      <i class="material-icons">place</i>{{ $post->region->name }}
    </a>
  </div>
</div>
