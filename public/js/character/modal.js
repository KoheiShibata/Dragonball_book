// modal表示
const characterList = document.querySelectorAll(".character-list__img")
for (let character of characterList) {
    character.addEventListener("click", function () {
        const json = JSON.parse(character.dataset.character)
        const content = character.dataset.content
        document.getElementById("exampleModalLabel").innerHTML = json.name
        document.getElementById("content").innerHTML = content
        getHeight().innerHTML = json.height
        getWeight().innerHTML = json.weight
        document.getElementById("tribe").innerHTML = json.tribe_name
        document.getElementById("season").innerHTML = json.season_name
        document.getElementById("attack").innerHTML = json.attack
        document.getElementById("defense").innerHTML = json.defense
        document.getElementById("ability").innerHTML = json.ability
        document.getElementById("popularity").innerHTML = json.popularity

        // 編集ボタン
        getEdit().setAttribute("href", `character/${json.id}`)
        // 削除ボタン
        const deleteBtn = getdeleteBtn()
        deleteBtn.value = json.id

        // 画像を生成
        const imageBox = document.getElementById("imageBox")
        imageBox.innerHTML = "";
        for (let imagePath of json.image_paths) {
            const img = document.createElement("img");
            img.src = imagePath
            img.className = "modalImage";
            img.alt = "画像なし";
            imageBox.appendChild(img)
        }
    })
}


// deleteAlert
function deleteBtnClickAlert() {
    const deleteBtn = getdeleteBtn()
    const characterId = deleteBtn.value
    const deleteForm = document.getElementById("character-delete-form")
    deleteForm.action = `character/${characterId}`
    if (!characterId) return

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        text: "本当に削除しますか？",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.submit()
        } else {
            return false;
        }
    })

}


// fetch
function getHeight() {
    return document.getElementById("height")
}

function getWeight() {
    return document.getElementById("weight")
}

function getdeleteBtn() {
    return document.getElementById("deleteBtn")
}

function getEdit() {
    return document.getElementById("edit")
}

