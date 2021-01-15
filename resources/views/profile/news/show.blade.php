@extends('profile.layout')
@section('title', 'خبر' . $new->user->fullname . ' در کد مالی ' . $new->fin_code)
@section('content')
    <div class="container  margin-v-large">
        <div class="row side-align">
            <div class="col m8-4 s12 ">
                <div class="z-depth-1 white">
                    @if ($new->getMedia('post-banner')->count())
                    <img src="{{ $new->getFirstMediaUrl('post-banner', 'banner') }}" alt="">
                    @else
                        <img src="/images/post/banner.jpg" alt="{{ $new->title }}">
                    @endif
                    <div class="container large">
                    <br>
                    <div>
                        <h1 class="headline margin-0">{{ $new->title }}</h1>
                        <div class="padding-v">
                            <a href="{{ route('blog.region', ['region' => $new->region]) }}"><i class="material-icons">place</i>{{ $new->region->name }}</a>
                            <div class="left caption">
                                {{ jdate($new->created_at)->format('l j F Y') }}
                            </div>
                        </div>
                    </div>
                    @foreach ($new->categories()->group('post')->get() as $category)
                        <a href="{{ route('blog.category', ['category' => $category]) }}">{{ $category->name }}</a>
                    @endforeach
                    {{ strip_tags(html_entity_decode($new->body)) }}
                    <br><br><br>
                    </div>
                </div>
            </div>
            <div class="col m3-6">
                <img src="/images/side1.png" class="margin-bottom z-depth-1 radius" >
            </div>
        </div>
        
    </div>
    
    <br><br>
@endsection
