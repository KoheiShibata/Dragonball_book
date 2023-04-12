@extends("layouts.zukan")

@section('loading.css')
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
@endsection

@section('header.css')
<link href="{{ asset('css/zukan.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/ranking.css') }}" rel="stylesheet">
@endsection

@section("title", "ドラゴンボールランキング")

@section("loading")
<div id="splash">
    <div id="splash_logo"><img src="{{asset('/storage/img/loading-1.gif')}}" alt="" class="fadeUp"></div>
</div>
@endsection

@section("main")
<main class="main">
    @foreach ($rankingData as $key => $characters)
    <section class="ranking__wrap" id="{{ $key }}">
        <h2 class="enquete__title"><span>／</span>{{ $characters[0]->title }}<span>／</span></h2>
        <ul class="character__list">
            @foreach($characters as $key => $character)
            <li class="character__item">
                <a href="/dragonball-pbook/{{ $character->id }}">
                    <div class="name__wrap">
                        <p><span>{{ $character->rank }}</span>位</p>
                        <h4>{{ $character->answer }}</h4>
                    </div>
                    <div class="character__wrap">
                        <img src="{{ $character->character_images[0] }}" alt="">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>獲得票数</th>
                                    <td class="vote"><span>{{ $character->vote_count }}</span>票</td>
                                </tr>
                                <tr>
                                    <th>シーズン</th>
                                    <td>{{ $character->season_name }}</td>
                                </tr>
                                <tr>
                                    <th>種族</th>
                                    <td>{{ $character->tribe_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </section>
    @endforeach
</main>


@endsection

@section("js")
<script src="{{asset('/js/character/loading.js')}}"></script>
@endsection