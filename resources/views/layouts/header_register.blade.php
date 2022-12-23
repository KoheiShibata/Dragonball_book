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

<!-------------------------------
@todo ❗前提で知っておいて欲しい知識
*reset.cssを使用してみよう 💁途中から入れると崩れるので,今回は使用しなくても良い
参考サイト: https://coliss.com/articles/build-websites/operation/css/css-reset-for-modern-browser.html
*BEMを使用してclass名を決めよう
参考サイト: https://zenn.dev/nagan/articles/dac6fa662f4dab
------------------------------->

<body>
    @yield("loading")
    @yield("returnBtn")
    <!-------------------------------
    @todo
    *headerタグを使用してね
    ------------------------------->
    <div class="header">
        <!-------------------------------
        @todo
        *navタグでwrapしてね
        ------------------------------->
            <!-------------------------------
            @todo
            *class名ではなるべく番号は使わない。
            *例: 赤色だったら font--redなど
            ------------------------------->
            <div class="header-logo"><span class="logo-1">DRAGON</span><span class="logo-2">BALL</span><span class="logo-3">pbook</span></div>

        <!-------------------------------
        @todo
        *ulタグを使用しよう
        ------------------------------->
        <div class="header-list">
            <li><a href="{{ CHARACTER_CREATE_FORM }}">character</a></li>
            <li><a href="{{ SEASON_TOP }}">season</a></li>
            <li><a href="{{ TRIBE_TOP }}">tribe</a></li>
            <li><a href="{{ CHARACTER_TOP }}">list</a></li>
        </div>
    </div>
    @yield("main")

    <!--==============JQuery読み込み===============-->
    <!-------------------------------
    @todo
    *jQueryが2つあるのでどちらを読み込むか確認をしよう
    ------------------------------->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield("js")
</body>

</html>