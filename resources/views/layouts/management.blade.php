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
    <link rel="shortcut icon" sizes="480x480" href="{{ asset('/storage/img/dragonball-4.png') }}">
    @yield("loading.css")
    @yield("header.css")
    @yield("css")
    <title>@yield("title")</title>
</head>

<body>
    @yield("loading")
    @yield("returnBtn")
    <header class="header">
        <div class="header-logo">
            <span class="font--yellow">DRAGON</span>
            <span class="font--red">BALL</span>
            <span class="font--blue">PBOOK</span>
        </div>
        <nav class="header-nav">
            <ul class="header-nav__list">
                <li class="header-nav__item"><a href="{{ CHARACTER_CREATE_FORM }}">character</a></li>
                <li class="header-nav__item"><a href="{{ SEASON_TOP }}">season</a></li>
                <li class="header-nav__item"><a href="{{ TRIBE_TOP }}">tribe</a></li>
                <li class="header-nav__item"><a href="{{ CHARACTER_TOP }}">list</a></li>
            </ul>
        </nav>

        <div class="hamburger-btn" id="hamburgerBtn">
            <span class="hamburger-btn--passive"></span><span></span><span></span>
        </div>
        <nav class="hamburger-nav" id="hamburgerNav">
            <ul class="hamburger-menu">
                <li class="hamburger-menu__item"><a href="{{ CHARACTER_CREATE_FORM }}">character</a></li>
                <li class="hamburger-menu__item"><a href="{{ SEASON_TOP }}">season</a></li>
                <li class="hamburger-menu__item"><a href="{{ TRIBE_TOP }}">tribe</a></li>
                <li class="hamburger-menu__item"><a href="{{ CHARACTER_TOP }}">characterlist</a></li>
            </ul>
        </nav>
    </header>

    @yield("main")

    <footer class="footer">
        <p>© 2023 s-kohei</p>
    </footer>

    <!--==============JQuery読み込み===============-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield("js")
    <script>
        $(".hamburger-btn").click(function() {
            $(this).toggleClass('hamburger-btn--active');

            const hamburgerBtn = document.getElementById("hamburgerBtn").className
            const hamburgerNav = document.getElementById("hamburgerNav")

            if (hamburgerBtn == "hamburger-btn hamburger-btn--active") {
                hamburgerNav.style.display = "block"
            }
            if (hamburgerBtn == "hamburger-btn") {
                hamburgerNav.style.display = "none"
            }


        });

        $(".hamburger-nav").click(function() {
            document.getElementById("hamburgerBtn").classList.toggle("hamburger-btn--active")

            const hamburgerBtn = document.getElementById("hamburgerBtn").className
            const hamburgerNav = document.getElementById("hamburgerNav")

            if (hamburgerBtn == "hamburger-btn hamburger-btn--active") {
                hamburgerNav.style.display = "block"
            }
            if (hamburgerBtn == "hamburger-btn") {
                hamburgerNav.style.display = "none"
            }

        })
    </script>
</body>

</html>