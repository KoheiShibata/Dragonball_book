@extends("layouts.header_register")

@section("title", "シーズンの登録")

@section("main")
<div class="category_main">
    <h1 class="title">★シーズン登録</h1>
    <p class="info">※入力情報は後から変更できます</p>
    <form action="/season_create" method="post" id="form1" novalidate>
        @csrf
        <div class="form-group">
            <label class="category_label" for="name">☆シーズン名</label><br>
            <input type="text" class="form-control" name="name" id="name" value="" maxlength="30" autofocus required>
            <div class="valid-feedback">success!</div>
            <div class="invalid-feedback">シーズン名を入力してください。</div>
        </div>
        <button type="submit" id="btnSubmit" class="btn_button">登録</button>
    </form>

    <table>
        <label class="category_label">☆シーズン一覧</label>
        <div>
            @foreach($seasons as $season)
            <div class="edit" onclick="tableClick('{{$season->id}}', '{{$season->name}}')">
                <p class="season_name">{{$season->name}}</p>
                <img src="{{asset('/storage/img/trash-can-regular.svg')}}" class="child" onclick="deleteClick('{{$season->id}}', '{{$season->name}}')" alt="">
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
                <form action="/edit" method="post">
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
                    <p class="name" id="season_name"></p>
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // successAlert
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


        $(".edit").on("click", () => {
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
            document.getElementById("season_name").innerHTML = `シーズン名:${name}`
            const deleted = document.getElementById("delete")
            deleted.setAttribute("href", `/delete/${id}`)
        }

        // バリデーション
        (function() {
            var form = document.querySelector('#form1');
            form.addEventListener('submit', function(event) {
                form.querySelectorAll('.form-control').forEach(function(elm) {
                    var required = elm.required;
                    var maxlen = elm.getAttribute('data-maxlen');
                    var maxnum = elm.getAttribute('data-maxnum');
                    var regexp = elm.getAttribute('data-regexp');
                    if ((required && (elm.value.length == 0)) ||
                        (maxlen && (maxlen < elm.value.length)) ||
                        (maxnum && (maxnum < Number(elm.value))) ||
                        (regexp && !(elm.value.match(regexp)))) {
                        elm.classList.add('is-invalid');
                        elm.classList.remove('is-valid');
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        elm.classList.add('is-valid');
                        elm.classList.remove('is-invalid');
                    }
                });
            });
        })();
    </script>