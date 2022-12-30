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
    <link rel="stylesheet" type="text/css" href="/css/loading.css">
    @yield("header.css")
    @yield("css")
    <title>@yield("title")</title>
</head>

<body>
    @yield("loading")
    <header class="header">
        <div class="header-logo">
            <span class="font--yellow">DRAGON</span>
            <span class="font--red">BALL</span>
            <span class="font--blue">PBOOK</span>
        </div>
        <nav class="header-nav">
            <ul class="header-nav__list">
                <li class="header-nav__item" id="searchData" data-bs-toggle="modal" data-bs-target="#exampleModal" data-seasons="{{ json_encode($seasons) }}"><img src="{{asset('/storage/img/dragonballSerch.png')}}" alt=""></li>
            </ul>
        </nav>
    </header>

    @yield("main")

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/dragonball-pbook" method="get" id="search-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><img src="{{asset('/storage/img/dragonballSerch.png')}}" alt=""> シーズンやキーワードで探す</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="freewordBox">
                            <div class="seachTitle">
                                <p class="titleName"><img src="{{asset('/storage/img/sukauta-1.jpg')}}" alt=""><span class="titleString">freeword</span></p>
                            </div>
                            <input type="text" name="keyword" id="keyword" placeholder="名前やシーズンでさがす" value="{{session('keyword') ? session('keyword'): '' }}">
                        </div>
                        <div class="seasonCheckBox">
                            <div class="seachTitle">
                                <p class="titleName"><img src="{{asset('/storage/img/sukauta-1.jpg')}}" alt=""><span class="titleString">season</span></p>
                            </div>
                            <div class="searchArea">
                                @foreach($seasons as $season)
                                <label for="{{$season->name}}" id="label{{$season->name}}" class="checkboxLabel{{ session('seasonId') && in_array($season->id, session('seasonId'))  ? '_checkedBtn' : ''}}">
                                    <input type="checkbox" class="checkbox" id="{{$season->name}}" name="season[]" value="{{$season->id}}" onclick="checkboxId('{{$season->name}}')" {{ session("seasonId") && in_array($season->id, session('seasonId'))  ? "checked" : "" }}>{{$season->name}}</label>
                                @endforeach
                            </div>
                        </div>
                        <div class="tribeCheckBox">
                            <div class="serchTitle">
                                <p class="titleName"><img src="{{asset('/storage/img/sukauta-1.jpg')}}" alt=""><span class="titleString">tribe</span></p>
                            </div>
                            @foreach($tribes as $tribe)
                            <label for="{{$tribe->name}}" id="label{{$tribe->name}}" class="checkboxLabel{{ session('tribeId') && in_array($tribe->id, session('tribeId'))  ? '_checkedBtn' : '' }}">
                                <input type="checkbox" class="checkbox" id="{{$tribe->name}}" name="tribe[]" value="{{$tribe->id}}" onclick="checkboxId('{{$tribe->name}}')" {{ session("tribeId") && in_array($tribe->id, session('tribeId'))  ? "checked" : "" }}>{{$tribe->name}}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancelBtn" data-bs-dismiss="modal">キャンセル</button>
                        <button type="submit" class="serchBtn" id="btnSubmit" onclick="doubleSolutionSubmit()">検索</button>
                        <button type="button" class="resetBtn" onclick="unCheckAll()">リセット</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--==============JQuery読み込み===============-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>



    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('/js/character/checkBox.js')}}"></script>
    <script src="{{asset('/js/doubleSubmit.js')}}"></script>


    @yield("js")
</body>

</html>