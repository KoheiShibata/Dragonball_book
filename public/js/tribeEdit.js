function checkTribeEdit() {
    const editBtn = document.getElementById("editSubmit")
    editBtn.disabled = true
    // e.preventDefault()
    const tribeEditName = document.getElementById("modal_name").value
    const errorMessage = document.getElementById("modalTribeErrorMessage")
    let validation = "true"
    
    if (tribeEditName == "" || tribeEditName.length > 30) {
        errorMessage.style.display = "block"
        setTimeout(function () {
            editBtn.disabled = false
        }, 4000);
        validation = false
        return false
    }

    if(validation == "true") {
        const editForm = document.getElementById("editForm")
        editForm.submit()
    }

}