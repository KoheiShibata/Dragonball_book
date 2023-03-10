function imageClick(jsonData, jsonImages, content) {
    document.getElementById("exampleModalLabel").innerHTML = `${jsonData.name}`
    document.getElementById("content").innerHTML = content
    getHeight().innerHTML = jsonData.height
    getWeight().innerHTML = jsonData.weight
    document.getElementById("tribe").innerHTML = jsonData.tribe_name
    document.getElementById("season").innerHTML = jsonData.season_name
    document.getElementById("attack").innerHTML = jsonData.attack
    document.getElementById("defense").innerHTML = jsonData.defense
    document.getElementById("ability").innerHTML = jsonData.ability
    document.getElementById("popularity").innerHTML = jsonData.popularity
    // 編集ボタン
    getEdit().setAttribute("href", `character/${jsonData.id}`)
    // 削除ボタン
    const deleteBtn = getdeleteBtn()
    deleteBtn.value = jsonData.id

    for (let i = 0; i < 5; i++) {
        const imgSrc = document.getElementById(`imageList_${i}`)
        imgSrc.setAttribute("src", "")
        imgSrc.style.display = "none"
    }

    // 登録画像表示
    const images = jsonImages
    for (let i = 0; i < images.length; i++) {
        const characterImage = document.getElementById(`imageList_${i}`)
        characterImage.setAttribute("src", images[i])
        characterImage.style.display = "block"
    }

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

