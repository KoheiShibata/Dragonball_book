@extends("layouts.admin")

@section('loading.css')
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
@endsection

@section('header.css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/characterList.css') }}" rel="stylesheet">
@endsection

@section("title", "登録キャラクタ―一覧")

@section("loading")
<div id="splash">
    <div id="splash_logo"><img src="{{asset('/storage/img/loading-3.gif')}}" alt="" class="fadeUp"></div>
</div>
@endsection


@section("main")
<main class="main">
    <section>
        <ul class="character-list">
            @foreach($characters as $character)
            <li class="character-list__item">
                <img src="{{ $character->image_path }}" class="character-list__img" alt="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-content="{!! nl2br(e($character->content)) !!}" data-character="{{ $character }}">
                <p>{{ $character->name }}</p>
            </li>
            @endforeach
        </ul>
    </section>
</main>

<img src="{{ asset('/storage/img/dragonballSerch.png') }}" id="search-btn" data-bs-toggle="modal" data-bs-target="#search-modal" data-seasons="{{ json_encode($seasons) }}" alt="">

<!-- character Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <header class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </header>
            <div class="modal-body">
                <label class="subtitle-label">☆character image</label>
                <div id="imageBox">

                </div>
                <label class="contentTitle">☆content</label>
                <p class="modalContent" id="content"></p>
                <div class="characterInfo">
                    <div class="characterDetail">
                        <label class="subtitle-label">height</label>
                        <p class="modalHeight" id="height"></p>

                        <label class="subtitle-label">weight</label>
                        <p class="modalWeight" id="weight"></p>

                        <label class="subtitle-label">tribe</label>
                        <p class="modalTribe" id="tribe"></p>

                        <label class="subtitle-label">season</label>
                        <p class="modalSeason" id="season"></p>
                    </div>

                    <div class="characterStatus">
                        <label class="subtitle-label">attack</label>
                        <p class="modalStatus" id="attack"></p>

                        <label class="subtitle-label">defense</label>
                        <p class="modalStatus" id="defense"></p>

                        <label class="subtitle-label">ability</label>
                        <p class="modalStatus" id="ability"></p>

                        <label class="subtitle-label">popularity</label>
                        <p class="modalStatus" id="popularity"></p>
                    </div>
                </div>
            </div>
            <footer class="modal-footer">
                <a href="" class="edit" id="edit">edit</a>
                <a href="javascript:void(0)" class="delete" id="deleteBtn" onclick="deleteBtnClickAlert()">delete</a>
            </footer>
        </div>
    </div>
</div>


<!-- filter Modal -->
<div class="modal fade" id="search-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<form action="/" method="post" id="character-delete-form">
    @csrf
    @method("delete")
    <input type="hidden" name="id" id="character_id">
</form>

@endsection

@section("js")
<script src="{{asset('/js/doubleSubmit.js')}}"></script>
<script src="{{asset('/js/character/modal.js')}}"></script>
<script src="{{asset('/js/character/loading.js')}}"></script>
<script src="{{asset('/js/sweetAlert.js')}}"></script>

<script>
    window.addEventListener("load", function() {
        const successMessage = @json(session("successMessage"));
        if (successMessage) {
            window.setTimeout(function() {
                showSweetAlert("success", successMessage)
                return
            }, 2000);
        }
        const errorMessage = @json(session("errorMessage"));
        if (errorMessage) {
            window.setTimeout(function() {
                showSweetAlert("error", errorMessage)
                return
            }, 2000);
        }
    })
</script>


@endsection