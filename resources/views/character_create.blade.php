@extends("layouts.header_register")

@section("title", "キャラクターの登録")

@section("main")
<div class="main">
    <div class="title">
        <h1>♦新規登録</h1>
        <p>入力情報は後から変更できます</p>
    </div>
    <div class="form-body">
        <h1 class="subtitle">キャラクター情報</h1>    
        <form action="/create" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label class="control-label" for="name">キャラクター名</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="name">身長</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="name">体重</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="content">キャラクター説明</label><br>
                <textarea class="form-control" name="content" id="content" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="name">攻撃</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="name">防御</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="name">潜在能力</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label class="control-label" for="name">人気度</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
        </form>
    </div>




</div>