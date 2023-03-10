@extends("layouts.admin")

@section('header.css')
<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section("title", "カテゴリーの登録")

@section("main")
<div class="register_main">
    <h1 class="title">★Tribe registration</h1>
    <p class="info">※入力情報は後から変更できます</p>
    <form action="/tribe" method="post" id="form1">
        @csrf
        <div class="form-group">
            <label class="register_label" for="name">☆カテゴリー名</label><br>
            <input type="text" class="form-control" name="name" id="name" value="" autofocus>
            <div class="errorMessage" id="errorMessage">カテゴリー名を30文字以内で、正しく入力してください。</div>
        </div>
        <button type="submit" id="btnSubmit" class="btn_button" onclick="doubleSolutionSubmit()">登録</button>
    </form>

    <table>
        <label class="register_label">☆カテゴリー一覧</label>
        <div>
            @foreach($tribes as $tribe)
            <div class="tribe_table" onclick="tableClick({{ json_encode($tribe) }})">
                <p class="tribe_name">{{$tribe->name}}</p>
                <img src="{{ asset(DELETE_ICON_IMAGE_PATH) }}" class="child" onclick="deleteClick({{ json_encode($tribe) }})" alt="">
            </div>
            @endforeach
        </div>
    </table>
    <!-- Modal-edit -->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <b class="modal-title" id="exampleModalLabel">編集画面</b>
                <form action="/tribe" method="post" id="editForm" onsubmit="return checkTribeEdit()">
                    @csrf
                    @method("put")
                    <div class="modal-body">
                        <input type="hidden" name="id" id="modal_editId">
                        <input type="text" class="form-control" name="name" id="modal_name" value="">
                        <div class="errorMessage" id="modalTribeErrorMessage">カテゴリー名を30文字以内で、正しく入力してください。</div>
                    </div>
                    <div class="btn-area">
                        <button type="submit" class="btn btn-primary" id="editSubmit">更新</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal-delete -->
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <b class="modal-title" id="exampleModalLabel">※本当に削除してよろしいですか？</b>
                <form action="" method="post" id="tribe-delete-form">
                    @csrf
                    @method("delete")
                    <div class="modal-body">
                        <p>カテゴリー名</p>
                        <p class="name" id="tribe_name"></p>
                        <input type="hidden" name="id" id="modal_deleteId">
                    </div>
                    <div class="btn-area">
                        <button type="button" class="btn btn-danger" id="deleteBtn" data-session="{{ json_encode(session('tribeId')) }}" onclick="tribeDeleteBtnClick()">はい</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section("js")
    <script src="{{asset('/js/validation.js')}}"></script>
    <script src="{{asset('/js/tribeEdit.js')}}"></script>
    <script src="{{asset('/js/deleteBtn.js')}}"></script>
    <script src="{{asset('/js/sweetAlert.js')}}"></script>


    <script>
        window.addEventListener("load", function() {
            const successMessage = @json(session("successMessage"));
            if (successMessage) {
                showSweetAlert("success", successMessage)
                return
            }
            const errorMessage = @json(session("errorMessage"));
            if (errorMessage) {
                showSweetAlert("error", errorMessage)
                return
            }
        })


        $(".tribe_table").on("click", () => {
            const modal = new bootstrap.Modal(document.getElementById("modal-edit"), {
                keyboard: false
            })
            modal.show()
        })
        $(".child").on("click", (e) => {
            e.stopPropagation();
            const modal = new bootstrap.Modal(document.getElementById("modal-delete"), {
                keyboard: false
            })
            modal.show()
        })

        // 編集
        function tableClick(json) {
            document.getElementById("modal_name").value = json.name
            document.getElementById("modal_editId").value = json.id
        }
        // 削除
        function deleteClick(json) {
            console.log(json)
            document.getElementById("tribe_name").innerHTML = json.name
            document.getElementById("modal_deleteId").value = json.id
            document.getElementById("tribe-delete-form").action = `/tribe/${json.id}`
        }
    </script>
    @endsection