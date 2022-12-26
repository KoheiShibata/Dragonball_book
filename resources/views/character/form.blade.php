@extends("layouts.header_register")

@section('header.css')
<link href="{{ asset('css/header.css') }}" rel="stylesheet">
@endsection

@section('css')
<link href="{{ asset('css/character_create.css') }}" rel="stylesheet">
@endsection

@section("title", "キャラクターの登録")

@section("main")
<div class="main">
    <h1 class="title">★Character registration</h1>
    <p class="info">入力情報は後から変更できます<span class="required">(</span>は必須です)</p>
    <div class="form-body">
        <h1 class="subtitle">☆キャラクター情報</h1>
        <form action="/" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
                <label class="register-label required" for="name">☆キャラクター名</label><br>
                <input type="text" class="form-control" name="name" id="name" value="">
                <div class="err-msg-name"></div>
            </div>
            <div class="form-group">
                <label class="register-label">☆キャラクター画像</label><br>
                <label for="chkNo"><input type="radio" id="chkNo" name="checkPass" checked="checked" onclick="formSwitch()">なし</label>
                <label class="file_radio" for="chkYes"><input type="radio" id="chkYes" name="checkPass" onclick="formSwitch()">画像を選択する（最大5枚）</label>
            </div>
            <div class="input_area" id="inputArea">
                <div class="image_area">
                    <div id="preview-box">
                    </div>
                    <label for="preview_1" class="filelabel" id="label_1"><img src="{{asset('/storage/img/camera-solid.svg')}}" alt="">
                        <div class="push">画像を選択してください</div>
                    </label>
                    <input type="file" class="fileinput" name="image_1" id="preview_1" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <label class="register-label required" for="content">☆キャラクター説明</label><br>
                <textarea class="form-control" name="content" id="content" rows="10"></textarea>
                <div class="err-msg-content"></div>
            </div>
            <div class="form-group">
                <label class="register-label" for="height">☆身長</label><br>
                <input type="text" class="form-control" name="height" id="height" value="">
                <div class="err-msg-height"></div>
            </div>
            <div class="form-group">
                <label class="register-label" for="weight">☆体重</label><br>
                <input type="text" class="form-control" name="weight" id="weight" value="">
                <div class="err-msg-weight"></div>
            </div>
            <label for="tribe" class="register-label required">カテゴリー</label>
            <select name="tribe" class="chart" id="tribe" required>
                <option value="">選択してください</option>
                @foreach($tribes as $tribe)
                <option value="{{ $tribe->id }}">{{ $tribe->name }}</option>
                @endforeach
            </select>
            <div class="err-msg-tribe"></div>
            <label for="season" class="register-label required">シーズン</label>
            <select name="season" class="chart" id="season" required>
                <option value="">選択してください</option>
                @foreach($seasons as $season)
                <option value="{{ $season->id }}">{{ $season->name }}</option>
                @endforeach
            </select>
            <div class="err-msg-season"></div>
            <label for="attack" class="register-label required">攻撃</label>
            <select name="attack" class="chart" id="attack" required>
                <option value="">選択してください</option>
                @for ($i=1;$i<=10;$i++) <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
            </select>
            <div class="err-msg-attack"></div>
            <label for="defence" class="register-label required">守備</label>
            <select name="defence" class="chart" id="defence" required>
                <option value="">選択してください</option>
                @for ($i=1;$i<=10;$i++) <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
            </select>
            <div class="err-msg-defence"></div>
            <label for="ability" class="register-label required">潜在能力</label>
            <select name="ability" class="chart" id="ability" required>
                <option value="">選択してください</option>
                @for ($i=1;$i<=10;$i++) <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
            </select>
            <div class="err-msg-ability"></div>
            <label for="popularity" class="register-label required">人気度</label>
            <select name="popularity" class="chart" id="popularity" required>
                <option value="">選択してください</option>
                @for ($i=1;$i<=10;$i++) <option value="{{$i}}">{{ $i }}</option>
                    @endfor
            </select>
            <div class="err-msg-popularity"></div>
            <button type="button" id="btnSubmit" class="btn_button">登録</button>

        </form>
    </div>
    @endsection

    @section("js")
    <script src="{{asset('/js/doubleSubmit.js')}}"></script>
    <script src="{{asset('/js/character/registerSubmit.js')}}"></script>
    <script src="{{asset('/js/character/fetchFormValue.js')}}"></script>
    <script src="{{asset('/js/character/validations.js')}}"></script>
    <script src="{{asset('/js/sweetAlert.js')}}"></script>

    <script>
        addEvent(1)

        function formSwitch() {
            const chkYes = document.getElementById("chkYes");
            const inputArea = document.getElementById("inputArea");
            inputArea.style.display = chkYes.checked ? "block" : "none";
        }


        function addEvent(id) {

            const preview = document.getElementById(asPreviewId(id))
            preview.addEventListener("change", (e) => {
                const previewBox = document.getElementById("preview-box")

                // divタグを生成する
                const previewList = document.createElement("div")
                previewList.setAttribute("class", "preview-list")
                previewList.setAttribute("id", asPreviewListId(id))
                previewBox.appendChild(previewList)

                // プレビュー画像を表示/バリデーション
                const file = e.target.files[0];
                const fileSize = file.size
                const reader = new FileReader()
                reader.addEventListener("load", function() {
                    // 画像ファイルを base64 文字列に変換
                    const base64 = reader.result
                    // const blob = window.URL.createObjectURL(file);
                    const previewImage = createPreviwImage(id, base64)
                    previewList.appendChild(previewImage)
                }, false);
                reader.readAsDataURL(file);


                // 削除ボタンを作成する
                const deleteBtn = createDeleteBtnById(id)
                previewList.appendChild(deleteBtn)

                //inputLabelを隠す
                hiddenInputLabelById(id)

                const nextId = getNextId()

                // if (nextId > 5) return

                creatInputAreaById(nextId)

                if (fileSize >= 5242880) {
                    Swal.fire({
                        icon: 'error',
                        text: 'アップロードするファイルのサイズ上限は5MBです',
                    })
                    onClickDeleteBtn(id)
                }
                addEvent(nextId)

            })
        }


        function getNextId() {
            return getChildrenMaxId() + 1
        }

        function getChildrenMaxId() {
            const initId = 1;
            const previewAreaLastElement = document.getElementById("preview-box").lastElementChild
            if (!previewAreaLastElement) return initId
            return previewAreaLastElement.children[0] ? Number(previewAreaLastElement.children[0].id.replace('deleteBtn_', '')) : initId
        }

        function createPreviwImage(id, base64) {
            const previewImage = document.createElement("img")
            previewImage.setAttribute("src", base64)
            previewImage.setAttribute("class", `preview-img`)
            previewImage.setAttribute("id", asPreviewImageId(id))

            return previewImage
        }

        function createDeleteBtnById(id) {
            const deleteButton = document.createElement("a")
            deleteButton.setAttribute("href", "javascript:void(0)")
            deleteButton.setAttribute("class", "delete-button")
            deleteButton.setAttribute("onclick", `onClickDeleteBtn(${id})`)
            deleteButton.setAttribute("id", `deleteBtn_${id}`)
            deleteButton.innerHTML = "×"
            return deleteButton
        }

        function creatInputAreaById(id) {
            const imagePath = "{{asset('/storage/img/camera-solid.svg')}}"

            // label_fieldを作成(label)
            const newLabelField = document.createElement("label")
            newLabelField.setAttribute("for", asPreviewId(id))
            newLabelField.setAttribute("id", asLabelId(id))

            const maxPreviewCount = document.querySelector('#preview-box').childElementCount;
            if (maxPreviewCount < 5) {
                newLabelField.setAttribute("class", "filelabel")
            }
            if (maxPreviewCount == 5) {
                newLabelField.setAttribute("class", "filelabel__disabled")
            }

            // label_fieldを追加する
            const labelFields = document.querySelector(".image_area")
            labelFields.appendChild(newLabelField)
            const labelImage = document.getElementById(asLabelId(id))
            labelImage.innerHTML = `<img src="${imagePath}" alt=""><div class="push">＋</div>`


            // file_fieldを作成(input)
            const newFileField = document.createElement("Input")
            newFileField.setAttribute("id", asPreviewId(id))
            newFileField.setAttribute("name", asImageId(id))
            newFileField.setAttribute("type", "file")
            newFileField.setAttribute("class", "fileinput")
            newFileField.setAttribute("accept", "image/*")

            // file_fieldを追加
            const fileFields = document.querySelector(".image_area")
            fileFields.appendChild(newFileField)
        }

        function hiddenInputLabelById(id) {
            const inputLabel = document.getElementById(asLabelId(id))
            inputLabel.style.display = "none";
        }

        function onClickDeleteBtn(deleteId) {
            const previewList = document.getElementById(asPreviewListId(deleteId))
            previewList.remove()
            const deleteInput = document.getElementById(asPreviewId(deleteId))
            deleteInput.remove()

            // 画像が5枚から4枚になった時にlabelを押せるclass名に変更する
            const maxPreviewCount = document.querySelector('#preview-box').childElementCount
            const maxLabelCount = document.querySelectorAll('.image_area label').length
            if (maxPreviewCount == 4) {
                const changeLabel = document.getElementById(`label_${maxLabelCount}`)
                changeLabel.className = "filelabel"
            }
        }


        function asPreviewListId(id) {
            return `preview_list_${id}`
        }

        function asPreviewId(id) {
            return `preview_${id}`
        }

        function asLabelId(id) {
            return `label_${id}`
        }

        function asImageId(id) {
            return `image_${id}`
        }

        function asPreviewImageId(id) {
            return `previewImage_${id}`
        }
    </script>

    @endsection



</div>