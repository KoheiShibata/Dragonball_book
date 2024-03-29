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
                    <li class="header-nav__item"><a href="{{ route('ranking') }}">ranking</a></li>
                    <li class="header-nav__item header-nav__item--search" id="searchData" data-bs-toggle="modal" data-bs-target="#exampleModal" data-seasons="{{ json_encode($seasons) }}"><img src="{{asset('/storage/img/dragonballSerch.png')}}" alt=""></li>
                </ul>
            </nav>
        </div>
    </header>


    @yield("main")

    <footer class="footer">
        <p>© 2023 s-kohei Dragonball-pbook</p>
    </footer>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="{{asset('/js/doubleSubmit.js')}}"></script>
    <script>
        if (($(".character-list").length)) {
            $("#searchData").css("display", "block");
        }
    </script>
    @yield("js")
</body>

</html>