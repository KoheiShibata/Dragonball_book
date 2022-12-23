@extends("layouts.header_register")

@section('header.css')
<link href="{{ asset('css/header.css') }}" rel="stylesheet">
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
            <div class="tribe_table" onclick="tableClick('{{$tribe->id}}', '{{$tribe->name}}')">
                <p class="tribe_name">{{ $tribe->name }}</p>
                <img src="{{ DELETE_ICON_IMAGE_PATH }}" class="child" onclick="deleteClick('{{$tribe->id}}', '{{$tribe->name}}')" alt="">
            </div>
            @endforeach
        </div>
    </table>
    <!-- Modal-edit -->
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">編集画面</h5>
                </div>
                <form action="/tribe" method="post" id="editForm" onsubmit="return checkTribeEdit()">
                    @csrf
                    @method("put")
                    <div class="modal-body">
                        <input type="text" class="form-control" name="name" id="modal_name" value="">
                        <div class="errorMessage" id="modalTribeErrorMessage">カテゴリー名を30文字以内で、正しく入力してください。</div>
                        <input type="hidden" name="id" id="modal_editId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary" id="editSubmit">更新</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal-delete -->
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">※本当に削除してよろしいですか？</h5>
                </div>
                <form action="" method="post" id="tribe-delete-form">
                    @csrf
                    @method("delete")
                    <div class="modal-body">
                        <p class="name" id="tribe_name"></p>
                        <input type="hidden" name="id" id="modal_deleteId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                        <button type="button" class="btn btn-danger" id="deleteBtn" onclick="tribeDeleteBtnClick()">はい</button>
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
        function tableClick(id, name) {
            document.getElementById("modal_name").value = `${name}`
            document.getElementById("modal_editId").value = `${id}`

        }
        // 削除
        function deleteClick(id, name) {
            document.getElementById("tribe_name").innerHTML = `カテゴリー名:${name}`
            document.getElementById("modal_deleteId").value = `${id}`
            document.getElementById("tribe-delete-form").action = `/tribe/${id}`
        }
    </script>
    @endsection