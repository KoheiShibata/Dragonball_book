<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" sizes="480x480" href="{{ asset('/storage/img/dragonball-4.png') }}">
    <link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/css/home.css">
    <title>ドラゴンボール図鑑サイト</title>
</head>

<body>
    <main class="main">
        <div class="main__wrapper">
            <h1 class="title">
                <span>／</span>Welcome DragonBall Pbook<span>／</span>
            </h1>
            <div class="home__img">
                <img src="{{ asset('/storage/img/goku-home.png') }}" alt="">
            </div>
            <ul class="season__list">
                @foreach($seasons as $season)
                <li class="season__item">
                    <a href="{{ PBOOK_TOP }}?{{ urlencode('season[]') }}={{ $season->id }}">{{ $season->name }}</a>
                </li>
                @endforeach
                <li class="season__item pbook__redirect">
                    <a href="{{ route('ranking') }}" class="pbook__redirect">Dragonball pbook ranking</a>
                </li>
            </ul>
        </div>
    </main>
    <footer class="footer">
        <p>© 2023 s-kohei Dragonball-pbook</p>
    </footer>
</body>

</html>