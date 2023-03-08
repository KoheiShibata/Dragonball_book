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
                <p> 申し訳ございません。 <br>
                    お探しのページが見つかりません。<br>
                    指定されたページは削除されたか、名前が変更されたか、<br>
                    一時的にご利用ができない可能性がございます。</p>
                <a href="{{ route('home') }}">トップページに戻る</a>
                @if(session()->has("admin"))
                <a href="{{ CHARACTER_TOP }}">管理画面トップページに戻る</a>
                @endif
            </div>
        </section>
    </main>
</body>

</html>