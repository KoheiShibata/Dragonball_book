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
<!-- キャラクターがいないとき、表示 -->
<div class="character-none__message" id="characterNoneMessage">
    <p>表示できるキャラクタ―がいません。</p>
</div>

<main class="main">
    <section>
        <ul class="character-list" id="character-list">
            @foreach($characters as $character)
            <li class="character-list__item" onclick="onClickCharacterDetail('{{$character->id}}')">
                <img src="{{ $character->formated_image_path }}" alt="">
                <p>{{$character->name}}</p>
            </li>
            @endforeach
        </ul>
    </section>
</main>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <header class="modal-header">
                <h5 class="modal__title" id="exampleModalLabel"><img src="{{asset('/storage/img/dragonballSerch.png')}}" alt=""> シーズンやキーワードで探す</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </header>
            <form action="/" method="get" id="search-form" onsubmit="return false;">
                <div class="modal-body">
                    <section class="search-section">
                        <div class="search-section__title">
                            <img src="{{asset('/storage/img/sukauta-1.jpg')}}" alt="">
                            <p>freeword</p>
                        </div>
                        <div class="search-box">
                            <input type="text" name="keyword" id="keyword" placeholder="名前やシーズンでさがす" value="{{session('keyword') ? session('keyword'): '' }}" maxlength="40">
                        </div>
                    </section>
                    <section class="search-section">
                        <div class="search-section__title">
                            <img src="{{asset('/storage/img/sukauta-1.jpg')}}" alt="">
                            <p>season</p>
                        </div>
                        <div class="search-checkbox">
                            @foreach($seasons as $season)
                            <label for="{{$season->name}}" id="label{{$season->name}}" class="search-checkbox__label{{ session('season') && in_array($season->id, session('season'))  ? ' search-checkbox__label--checked' : ''}}">
                                <input type="checkbox" class="checkbox" id="{{$season->name}}" name="season[]" value="{{$season->id}}" onclick="checkboxId('{{$season->name}}')" {{ session("season") && in_array($season->id, session('season'))  ? "checked" : "" }}>{{$season->name}}</label>
                            @endforeach
                        </div>
                    </section>
                    <section class="search-section">
                        <div class="search-section__title">
                            <img src="{{asset('/storage/img/sukauta-1.jpg')}}" alt="">
                            <p>tribe</p>
                        </div>
                        <div class="search-checkbox">
                            @foreach($tribes as $tribe)
                            <label for="{{$tribe->name}}" id="label{{$tribe->name}}" class="search-checkbox__label{{ session('tribe') && in_array($tribe->id, session('tribe'))  ? ' search-checkbox__label--checked' : '' }}">
                                <input type="checkbox" class="checkbox" id="{{$tribe->name}}" name="tribe[]" value="{{$tribe->id}}" onclick="checkboxId('{{$tribe->name}}')" {{ session("tribe") && in_array($tribe->id, session('tribe'))  ? "checked" : "" }}>{{$tribe->name}}</label>
                            @endforeach
                        </div>
                    </section>
                </div>
                <footer class="modal-footer">
                    <button type="button" class="common-btn cancel-btn" data-bs-dismiss="modal">キャンセル</button>
                    <button type="button" class="common-btn serch-btn" id="btnSubmit">検索</button>
                    <div class="common-loading-area__submit--hide" id="loading-area__submit">
                        <img src="{{asset('/storage/img/loading-6.gif')}}" alt="">
                    </div>
                    <button type="button" class="common-btn reset-btn" onclick="unCheckAll()">リセット</button>
                </footer>
            </form>
        </div>
    </div>
</div>
@endsection

@section("js")
<script src="{{asset('/js/character/loading.js')}}"></script>
<script src="{{asset('/js/character/filter.js')}}"></script>
<script>
    function onClickCharacterDetail(id) {
        window.location.href = (`/dragonball-pbook/${id}`)
    }
</script>
@endsection