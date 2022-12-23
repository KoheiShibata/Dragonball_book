@extends("layouts.header_register")

@section('loading.css')
<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
@endsection

@section('header.css')
<link href="{{ asset('css/header.css') }}" rel="stylesheet">
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
<div class="main">
    <div id="container">
        <h1 class="title">★Character list</h1>
        <!-- {{ count($characters) }} -->
        <div class="characterList">
            @foreach($characters as $character)
            <div class="character">
                <img src="{{ $character->image_path }}" id="characterData" alt="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-content="{!! nl2br(e($character->content)) !!}" onclick="imageClick({{ json_encode($character) }}, `{!! nl2br(e($character->content)) !!}`)">
                <p class="characterName">{{$character->name}}</p>
            </div>
            @endforeach
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                    </div>
                    <div class="modal-body">
                        <label class="subtitle-label">☆character image</label>
                        <div  id="imageBox">
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
                    <div class="modal-footer">
                        <a href="" class="edit" id="edit">edit</a>
                        <a href="javascript:void(0)" class="delete" id="deleteBtn" onclick="deleteAlert()">delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section("js")
        <script src="{{asset('/js/doubleSubmit.js')}}"></script>
        <script src="{{asset('/js/character/modal.js')}}"></script>
        <script src="{{asset('/js/character/loading.js')}}"></script>


        @endsection

    </div>
</div>