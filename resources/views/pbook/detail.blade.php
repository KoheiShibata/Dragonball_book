@extends("layouts.zukan")

@section('header.css')
<link href="{{ asset('css/zukan.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/characterDetail.css') }}" rel="stylesheet">
@endsection


@section("title", "$character->name の詳細")


@section("main")
<main class="main">
    <div class="character">
        <div class="detail">
            <div class="desctiptionArea">
                <div class="contentArea">
                    <div class="character-name">
                        <span>{{$character->name}}</span>
                    </div>
                    <p class="content">{!! nl2br($character->content) !!}</p>
                </div>
                <div class="dataArea">
                    <ul class="text-list">
                        <li class="text-list__item">
                            <span>tribe</span>
                            <p>{{$character->tribe_name}}</p>
                        </li>
                        <li class="text-list__item">
                            <span>season</span>
                            <p>{{$character->season_name}}</p>
                        </li>
                        <li class="text-list__item">
                            <span>height</span>
                            <p>{{$character->formatedPbookHeight}}</p>
                        </li>
                        <li class="text-list__item">
                            <span>weight</span>
                            <p>{{$character->formatedPbookWeight}}</p>
                        </li>
                    </ul>
                    <div class="chartRadar">
                        <canvas id="myChart" class="myChart" data-character="{{ json_encode($character) }}"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="character-image">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach($character->image_paths as $imagePath)
                    <div class="swiper-slide"><img src="{{ asset($imagePath) }}" alt=""></div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</main>
@endsection


@section("js")
<script src="{{asset('/js/character/chartRadar.js')}}"></script>
<script src="{{asset('/js/character/swiper.js')}}"></script>

<script>
    function homeBtn() {
        history.back()
    }
</script>

@endsection