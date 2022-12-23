@extends("layouts.header_zukan")

@section('header.css')
<link href="{{ asset('css/headerZukan.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/characterDetail.css') }}" rel="stylesheet">
@endsection


@section("title", "$character->name の詳細")



@section("main")
<div class="main">
    <div class="character">
        <div class="detail">
            <div class="desctiptionArea">
                <div class="contentArea">
                    <div class="characterTitle">
                        <span>{{$character->name}}</span>
                    </div>
                    <p class="content">{!! nl2br($character->content) !!}</p>
                </div>
                <div class="dataArea">
                    <div class="textArea">
                        <span class="pointTitle">tribe</span>
                        <p class="tribe">{{$character->tribe_name}}</p>
                        <span class="pointTitle">season</span>
                        <p class="season">{{$character->season_name}}</p>
                        <span class="pointTitle">height</span>
                        <p class="height">{{$character->height}}</p>
                        <span class="pointTitle">weight</span>
                        <p class="weight">{{$character->weight}}</p>
                    </div>
                    <div class="chartRadar">
                        <canvas id="myChart" class="myChart" data-character="{{ json_encode($character) }}"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div style="position:relative">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @if(!empty($character->image_path))
                    @for($i=0;$i<count($character->image_path);$i++)
                        <div class="swiper-slide"><img src="{{ asset($character->image_path[$i]) }}" alt=""></div>
                        @endfor
                        @endif
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>


</div>
@endsection


@section("js")
<script src="{{asset('/js/character/chartRadar.js')}}"></script>
<script src="{{asset('/js/character/swiper.js')}}"></script>

@endsection