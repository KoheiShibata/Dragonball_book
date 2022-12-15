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
    <form action="/tribe_create" method="post" id="form1" onsubmit="return checkSubmit();" novalidate>
        @csrf
        <div class="form-group">
            <label class="register_label" for="name">☆カテゴリー名</label><br>
            <input type="text" class="form-control" name="name" id="name" value="" maxlength="30" autofocus required>
            <div class="valid-feedback">success!</div>
            <div class="invalid-feedback">カテゴリー名を入力してください。</div>
        </div>
        <button type="submit" id="btnSubmit" class="btn_button">登録</button>
    </form>

    <table>
        <label class="register_label">☆カテゴリー一覧</label>
        <div>
            @foreach($tribes as $tribe)
            <div class="tribe_table" onclick="tableClick('{{$tribe->id}}', '{{$tribe->name}}')">
                <p class="tribe_name">{{$tribe->name}}</p>
                <img src="{{asset('/storage/img/trash-can-regular.svg')}}" class="child" onclick="deleteClick('{{$tribe->id}}', '{{$tribe->name}}')" alt="">
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
                <form action="/tribe_edit" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control" name="name" id="modal_name">
                        <input type="hidden" name="id" id="modal_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">更新</button>
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
                <div class="modal-body">
                    <p class="name" id="tribe_name"></p>
                    <input type="hidden" name="id" id="modal_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">いいえ</button>
                    <a href="" class="btn btn-danger" id="delete">はい</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section("js")
    <script src="{{asset('/js/validation.js')}}"></script>
    <script src="{{asset('/js/doubleSubmit.js')}}"></script>

    <script>
        window.addEventListener("load", function() {
            const isSuccess = @json(session("successMessage"));
            if (isSuccess) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-center',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: isSuccess
                })
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
            document.getElementById("modal_id").value = `${id}`

        }
        // 削除
        function deleteClick(id, name) {
            document.getElementById("tribe_name").innerHTML = `カテゴリー名:${name}`
            const deleted = document.getElementById("delete")
            deleted.setAttribute("href", `/tribe_delete/${id}`)
        }
    </script>
    @endsection