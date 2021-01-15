@if (count($hotel->media))
    <div class="swiper-container margin-bottom z-depth-2 white">
    <div class="swiper-wrapper">
        @foreach ($hotel->media as $media)
        <div class="swiper-slide">
            <img src="{{ $media->getUrl('banner') }}" alt="">
            <div class="padding">
            <h1 class="title margin-0">{{ $media->name }}</h1>
            </div>
        </div>
        @endforeach
    </div>
    </div>
@endif
<div class="white z-depth-2 padding margin-bottom radius">
    <h1 class="title margin-0 margin-bottom">{{ $hotel->name }}</h1>
    <div><i class="material-icons">place</i> {{ $hotel->address }}</div>
    <div><i class="material-icons">phone</i> {{ $hotel->tel }}</div>
    <p>{!! html_entity_decode($hotel->about) !!}</p>
    @foreach ($hotel->featuresData() as $feature)
        <div class="col l2 m3 s4 center-align margin-bottom">
        <i class="material-icons">{{ $feature['icon'] }}</i><br>{{ $feature['name'] }}
        </div>
    @endforeach<div class="clearfix"></div>
</div>