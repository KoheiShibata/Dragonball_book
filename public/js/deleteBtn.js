function seasonDeleteBtnClick() {
    getDeleteBtn().disabled = true
    document.getElementById("season-delete-form").submit()
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

