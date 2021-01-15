@extends('profile.layout')
@section('content')
    <div class="container margin-v-large">
        <div class="row side-align">
            <div class="col m8-4 s12">
                <div class=" hold">
                    @forelse($news as $new)
                        @component('components.post-card', [
                            'route' => 'profile.news.show',
                            'post' => $new,
                        ]) @endcomponent
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="col m3-6">
                <img src="/images/side1.png" class="margin-bottom z-depth-1 radius" >
            </div>
        </div>
    </div>
@endsection