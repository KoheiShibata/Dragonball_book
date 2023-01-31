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
    <h1 class="title">★Character list</h1>
    <section>
        <ul class="character-list">
            @foreach($characters as $character)
            <li class="character-list__item">
                <img src="{{ $character->formated_image_path }}" id="characterData" alt="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-content="{!! nl2br(e($character->content)) !!}" onclick="imageClick( {{ json_encode($character) }}, {{ json_encode($characterImages[$character->id]) }}, `{!! nl2br(e($character->content)) !!}`)">
                <p>{{ $character->name }}</p>
            </li>
            @endforeach
        </ul>
    </section>
</main>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <header class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </header>
            <div class="modal-body">
                <label class="subtitle-label">☆character image</label>
                <div id="imageBox">
                    <img class="modalImage" src="" id="imageList_0" alt="">
                    <img class="modalImage" src="" id="imageList_1" alt="">
                    <img class="modalImage" src="" id="imageList_2" alt="">
                    <img class="modalImage" src="" id="imageList_3" alt="">
                    <img class="modalImage" src="" id="imageList_4" alt="">
                </div>

                <!-- <p class="imageComent" id="unregistered"></p> -->
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