<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/error.css">
    <title>dragonball</title>
</head>

<body>
    <main class="error">
        <section class="error__wrapper">
            <img src="{{asset('/storage/img/cellError.png')}}" alt="">
            <div class="error__title">
                <h2>404</h2>
                <p>not found</p>
            </div>
            <div class="error__desc">
                <p> 申し訳ございません。お探しのページが見つかりません。<br>
                    指定されたページは削除されたか、名前が変更されたか、一時的にご利用ができない可能性がございます。</p>
                <a href="{{ PBOOK_TOP }}">トップページに戻る</a>
            </div>
        </section>
    </main>
</body>

</html>