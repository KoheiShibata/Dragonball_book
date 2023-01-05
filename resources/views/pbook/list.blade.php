@extends("layouts.header_zukan")

@section('loading.css')
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
@endsection

@section('header.css')
<link href="{{ asset('css/headerZukan.css') }}" rel="stylesheet">
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
    <div id="container">
        <div class="characterList">
            @if($characters->isEmpty())
            <div class="noCharacter">表示できるキャラクタ―がいません。</div>
            @endif
            @foreach($characters as $character)
            <div class="character" id="character" onclick="onClickCharacterDetail('{{$character->id}}')">
                <img src="{{ $character->formated_image_path }}" id="characterData" alt="">
                <p class="characterName">{{$character->name}}</p>
            </div>
            @endforeach
        </div>
    </div>
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