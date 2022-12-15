@extends("layouts.header_zukan")

@section('header.css')
<link href="{{ asset('css/headerZukan.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/characterZukan.css') }}" rel="stylesheet">
@endsection

@section("title", "ドラゴンボール図鑑")

@section("main")
<div class="main">
    <div class="characterList">
        @foreach($characters as $character)
        <div class="character" id="character" onclick="onClickCharacterDetail('{{$character->id}}')">
            <img src="{{ $character->image_path }}" id="characterData" alt="">
            <p class="characterName">{{$character->name}}</p>
        </div>
        @endforeach
    </div>
</div>

<script>
    function onClickCharacterDetail(id) {
        window.location.href= (`/character_detail/${id}`)
    }
</script>