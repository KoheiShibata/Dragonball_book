<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name=”viewport” content=”width=device-width,initial-scale=1.0″>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <link rel="shortcut icon" sizes="480x480" href="{{ asset('/storage/img/dragonball-4.png') }}">
    <link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <link rel="stylesheet" type="text/css" href="/css/loading.css">
    @yield("header.css")
    @yield("css")
    <title>@yield("title")</title>
</head>

<body>
    @yield("loading")
    <header class="header">
        <div class="header-wrapper">
            <a href="/dragonball-pbook" class="header-logo">
                <span class="font--yellow">DRAGON</span>
                <span class="font--red">BALL</span>
                <span class="font--blue">PBOOK</span>
            </a>
            <nav class="header-nav">
                <ul class="header-nav__list">
                    <li class="header-nav__item" id="searchData" data-bs-toggle="modal" data-bs-target="#exampleModal" data-seasons="{{ json_encode($seasons) }}"><img src="{{asset('/storage/img/dragonballSerch.png')}}" alt=""></li>
                </ul>
            </nav>
        </div>
    </header>


    @yield("main")

    <footer class="footer">
        <p>© 2023 s-kohei Dragonball-pbook</p>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <header class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><img src="{{asset('/storage/img/dragonballSerch.png')}}" alt=""> シーズンやキーワードで探す</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </header>
                <form action="/dragonball-pbook" method="get" id="search-form">
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
                                    <input type="checkbox" class="checkbox" id="{{$season->name}}" name="season[]" value="{{$season->id}}" onclick="checkboxId('{{$season->name}}')" {{ session("seasonId") && in_array($season->id, session('seasonId'))  ? "checked" : "" }}>{{$season->name}}</label>
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
                                    <input type="checkbox" class="checkbox" id="{{$tribe->name}}" name="tribe[]" value="{{$tribe->id}}" onclick="checkboxId('{{$tribe->name}}')" {{ session("tribeId") && in_array($tribe->id, session('tribeId'))  ? "checked" : "" }}>{{$tribe->name}}</label>
                                @endforeach
                            </div>
                        </section>
                    </div>
                    <footer class="modal-footer">
                        <button type="button" class="cancel-btn" data-bs-dismiss="modal">キャンセル</button>
                        <button type="submit" class="serch-btn" id="btnSubmit" onclick="doubleSolutionSubmit()">検索</button>
                        <button type="button" class="reset-btn" onclick="unCheckAll()">リセット</button>
                    </footer>
                </form>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('/js/character/checkBox.js')}}"></script>
    <script src="{{asset('/js/doubleSubmit.js')}}"></script>
    @yield("js")
</body>

</html>