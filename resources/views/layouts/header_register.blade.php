<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    @yield("loading.css")
    @yield("header.css")
    @yield("css")
    <title>@yield("title")</title>
</head>

<body>
    @yield("loading")
    @yield("returnBtn")
    <div class="header">
        <div class="header-logo"><span class="logo-1">DRAGON</span><span class="logo-2">BALL</span><span class="logo-3">pbook</span></div>
        <div class="header-list">
            <li><a href="{{ CHARACTER_CREATE_FORM }}">character</a></li>
            <li><a href="{{ SEASON_TOP }}">season</a></li>
            <li><a href="{{ TRIBE_TOP }}">tribe</a></li>
            <li><a href="{{ CHARACTER_TOP }}">list</a></li>
        </div>
    </div>
    @yield("main")

    <!--==============JQuery読み込み===============-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield("js")
</body>

</html>