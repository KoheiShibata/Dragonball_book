// チェックボックスイベント
function checkboxId(checkId) {
    const checkboxId = document.getElementById(checkId)
    const labelId = document.getElementById(`label${checkId}`)
    if (checkboxId.checked == true) {
        labelId.className = "search-checkbox__label search-checkbox__label--checked"
    }
    if (checkboxId.checked == false) {
        labelId.className = "search-checkbox__label"
    }
}

// フィルターリセット
function unCheckAll() {
    const checkboxlList = document.getElementsByClassName("checkbox")
    const keyword = document.getElementById("keyword")
    keyword.value = ""

    for (const checkbox of checkboxlList) {
        checkbox.checked = false
        const checkboxId = checkbox.getAttribute("id")
        document.getElementById(`label${checkboxId}`).className = "search-checkbox__label"
    }

}

// フィルター検索
const btnSubmit = document.getElementById("btnSubmit")
const loadingGifSubmit = document.getElementById("loading-area__submit")
const characterNoneMessage = document.getElementById("characterNoneMessage")
btnSubmit.addEventListener("click", () => {
    btnChangeLoading(btnSubmit, loadingGifSubmit)
    characterNoneMessage.className = "character-none__message"
    $("#exampleModal").modal("hide")
    $("#splash").show();
    $("#splash_logo").show();

    let param = {
        keyword: document.getElementById("keyword").value,
        season: Array.from(document.querySelectorAll('input[name="season[]"]:checked')).map(e => e.value),
        tribe: Array.from(document.querySelectorAll('input[name="tribe[]"]:checked')).map(e => e.value)
    }
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: `/dragonball-pbook/filtering`,
        type: "GET",
        data: param,
    })
        // Ajaxリクエストが成功した時発動
        .done((data) => {
            const characters = data

            // 検索のキャラクターが存在しない場合
            if (Object.values(characters).length === 0) {
                characterNoneMessage.className = "character-none__message message--active"
                loadingChangeBtn(btnSubmit, loadingGifSubmit)
                $("#splash").fadeOut('slow');
                $("#splash_logo").fadeOut('slow');
            }

            const characterList = document.getElementById("character-list");
            characterList.innerHTML = "";
            let loadedCount = 0;
            Object.values(characters).forEach((character) => {
                const li = document.createElement("li");

                li.className = "character-list__item";
                li.onclick = function () {
                    onClickCharacterDetail(character.id);
                };

                const img = document.createElement("img");
                img.src = character.image_path;
                img.alt = "";

                const p = document.createElement("p");
                p.innerText = character.name;

                li.appendChild(img);
                li.appendChild(p);
                characterList.appendChild(li);

                // 画像の読み込みが終了するまで、ローディング画面を表示する
                img.onload = function () {
                    loadedCount++;
                    if (loadedCount === Object.values(characters).length) {
                        loadingChangeBtn(btnSubmit, loadingGifSubmit)
                        $("#splash").fadeOut('slow');
                        $("#splash_logo").fadeOut('slow');
                    }
                };
            });
        })
        // Ajaxリクエストが失敗した時発動
        .fail((data) => {
            loadingChangeBtn(btnSubmit, loadingGifSubmit)
            $("#splash").fadeOut('slow');
            $("#splash_logo").fadeOut('slow');
        })
    // Ajaxリクエストが成功・失敗どちらでも発動
})