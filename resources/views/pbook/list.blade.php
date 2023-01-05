@extends("layouts.zukan")

@section('loading.css')
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
@endsection

@section('header.css')
<link href="{{ asset('css/zukan.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/characterZukan.css') }}" rel="stylesheet">
@endsection

@section("title", "ドラゴンボール図鑑")

@section("loading")
<div id="splash">
    <div id="splash_logo"><img src="{{asset('/storage/img/loading-1.gif')}}" alt="" class="fadeUp"></div>
</div>
@endsection

@section("main")
<main class="main">
    <section>
        @if($characters->isEmpty())
        <div class="character-none--message">表示できるキャラクタ―がいません。</div>
        @endif
        <ul class="character-list">
            @foreach($characters as $character)
            <li class="character-list__item"  onclick="onClickCharacterDetail('{{$character->id}}')">
                <img src="{{ $character->formated_image_path }}" id="characterData" alt="">
                <p>{{$character->name}}</p>
            </li>
            @endforeach
        </ul>
    </section>
</main>
@endsection

@section("js")
<script src="{{asset('/js/character/loading.js')}}"></script>


<script>
    function onClickCharacterDetail(id) {
        window.location.href = (`/dragonball-pbook/${id}`)
    }
</script>
@endsection