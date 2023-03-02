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
    <main>
        <h1 class="title">Welcome DragonBall Pbook</h1>
        <ul class="dragonball-logo__list">
            <li class="dragonball-logo__item">
                <img src="{{ asset('/storage/img/dragonball-unmarked.png') }}" alt="">
            </li>
            <li class="dragonball-logo__item">
                <img src="{{ asset('/storage/img/dragonball-z.png') }}" alt="">
            </li>
            <li class="dragonball-logo__item">
                <img src="{{ asset('/storage/img/dragonball-super.png') }}" alt="">
            </li>
            <li class="dragonball-logo__item">
                <img src="{{ asset('/storage/img/dragonball-gt.png') }}" alt="">
            </li>
        </ul>
        <a href="{{ PBOOK_TOP }}">Dragonball-pbook</a>
    </main>
</body>
</html>