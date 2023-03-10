
function seasonDeleteBtnClick() {
    getDeleteBtn().disabled = true
    let notDeleteSeason = getDeleteBtn().dataset.session
    if (notDeleteSeason.includes(getDeleteId()) === true) {
        Swal.fire({
            icon: 'error',
            html: '<p>こちらのシーズンはご使用中のため<br>削除することができません。</p>',
        })
        $("#modal-delete").modal('hide');
        getDeleteBtn().disabled = false
        return
    }
    document.getElementById("season-delete-form").submit()
}

function tribeDeleteBtnClick() {
    getDeleteBtn().disabled = true
    let notDeleteTribe = getDeleteBtn().dataset.session
    console.log(notDeleteTribe)
    if (notDeleteTribe.includes(getDeleteId()) === true) {
        Swal.fire({
            icon: 'error',
            html: '<p>こちらのカテゴリーはご使用中のため<br>削除することができません。</p>',
        })
        $("#modal-delete").modal('hide');
        getDeleteBtn().disabled = false
        return
    }

    document.getElementById("tribe-delete-form").submit()
}




// 値を返す関数
function getDeleteBtn() {
    return document.getElementById("deleteBtn")
}

function getDeleteId() {
    return document.getElementById("modal_deleteId").value
}

