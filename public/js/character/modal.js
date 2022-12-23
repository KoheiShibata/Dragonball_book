function imageClick(jsonData, content) {
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
    getEdit().setAttribute("href", `character_edit/${jsonData.id}`)
    // 削除ボタン
    const deleteBtn = getdeleteBtn()
    deleteBtn.value = jsonData.id

    if (jsonData.height == null) {
        getHeight().innerHTML = "未登録"
    }

    if (jsonData.weight == null) {
        getWeight().innerHTML = "未登録"
    }


    for (let i = 0; i < 5; i++) {
        const imgSrc = document.getElementById(`imageList_${i}`)
        imgSrc.setAttribute("src", "")
        imgSrc.style.display = "none"
    }
    // 登録画像がない場合
    if (jsonData.image_path = "http://127.0.0.1:8000/storage/img/noimage.png") {
        const noImage = document.getElementById("imageList_0")
        noImage.setAttribute("src", "http://127.0.0.1:8000/storage/img/noimage.png")
        noImage.style.display = "block"
    }

    // 登録画像表示
    const images = jsonData.image
    for (let i = 0; i < images.length; i++) {
        const characterImage = document.getElementById(`imageList_${i}`)
        characterImage.setAttribute("src", images[i].image_path)
        characterImage.style.display = "block"
    }

}







// deleteAlert
function deleteAlert() {
    const deleteBtn = getdeleteBtn()
    const characterId = deleteBtn.value
    if (!characterId) return

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-secondary'
        },
        buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
        // title: '本当に削除しますか?',
        text: "本当に削除しますか？",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = `/character_delete/${characterId}`
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

