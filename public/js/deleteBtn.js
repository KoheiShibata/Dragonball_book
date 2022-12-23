function seasonDeleteBtnClick() {
    getDeleteBtn().disabled = true
    const deleteId = getDeleteId()

    window.location.href = (`/season_delete/${deleteId}`)
}

function tribeDeleteBtnClick() {
    getDeleteBtn().disabled = true
    document.getElementById("tribe-delete-form").submit()
}




// 値を返す関数
function getDeleteBtn() {
    return document.getElementById("deleteBtn")
}

function getDeleteId() {
    return document.getElementById("modal_deleteId").value
}

