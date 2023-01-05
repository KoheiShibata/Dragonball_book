function checkboxId(checkId) {
    const checkboxId = document.getElementById(checkId)
    const labelId = document.getElementById(`label${checkId}`)
    if (checkboxId.checked == true) {
        labelId.className = "search-checkbox__label--checked"
    }
    if (checkboxId.checked == false) {
        labelId.className = "search-checkbox__label"
    }
}

function unCheckAll() {
    const checkboxlList = document.getElementsByClassName("checkbox")
    const keyword = document.getElementById("keyword")
    keyword.value = ""

    for(const checkbox of checkboxlList){
        checkbox.checked = false
        const checkboxId = checkbox.getAttribute("id")
        document.getElementById(`label${checkboxId}`).className = "search-checkbox__label"
    }

}