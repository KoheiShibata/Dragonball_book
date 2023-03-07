<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" sizes="480x480" href="{{ asset('/storage/img/dragonball-4.png') }}">
    <link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <title>ログイン</title>
</head>

<body>
    <div class="login-form">
        <div class="title__wrap">
            <img src="/img/shenlong.jpg" alt="">
            <h1><span>／</span>LOGIN<span>／</span></h1>
        </div>
        <div class="form__wrap">
            <form action="" method="post" name="loginForm">
                @csrf
                <div class="form-group">
                    <label for="name" class="login-form__label required">email</label><br>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name" class="login-form__label required">password</label><br>
                    <input type="password" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
                <button type="button" id="btnSubmit" class="btn-button">ログイン</button>
                <div class="common-loading-area__submit--hide" id="loading-area__submit">
                    <img src="{{asset('/storage/img/loading-6.gif')}}" alt="">
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('/js/doubleSubmit.js')}}"></script>
    <script>
        const btnSubmit = document.getElementById("btnSubmit")
        const loadingGifSubmit = document.getElementById("loading-area__submit")
        btnSubmit.addEventListener("click", function() {
            btnChangeLoading(btnSubmit, loadingGifSubmit)
        })
    </script>
</body>

</html>