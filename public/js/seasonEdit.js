
function checkSeasonEdit() {
    const editBtn = document.getElementById("editSubmit")
    editBtn.diabled = true


    const seasonEditName = document.getElementById("modal_name").value
    const errorMessage = document.getElementById("modalSeasonErrorMessage")
    let validation = "true"

    if (seasonEditName == "" || seasonEditName.length > 30) {
        errorMessage.style.display = "block"
        setTimeout(function () {
            editBtn.disabled = false
        }, 4000);
        validation = false
        return false
    }

    if(validation == "true") {
        const editForm = document.getElementById("season-edit-form")
        editForm.submit()
    }
}