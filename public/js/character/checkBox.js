function checkboxId(checkId) {
    const checkboxId = document.getElementById(checkId)
    const labelId = document.getElementById(`label${checkId}`)
    if (checkboxId.checked == true) {
        labelId.className = "checkboxLabel_checkedBtn"
    }
    if (checkboxId.checked == false) {
        labelId.className = "checkboxLabel"
    }
}

function unCheckAll() {
    const checkboxlList = document.getElementsByClassName("checkbox")
    const keyword = document.getElementById("keyword")
    keyword.value = ""

    for(const checkbox of checkboxlList){
        checkbox.checked = false
        const checkboxId = checkbox.getAttribute("id")
        document.getElementById(`label${checkboxId}`).className = "checkboxLabel"
    }
    // for(i = 0; i < checkbox.length; i++) {
    //     checkbox[i].checked = false
    //     let checkboxId = checkbox[i].getAttribute("id")
    //     document.getElementById(`label${checkboxId}`).className = "checkboxLabel"
    // }

}