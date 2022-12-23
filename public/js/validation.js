// 二重サブミット対策/バリデーション
function doubleSolutionSubmit() {
    const btnSubmit = document.getElementById("btnSubmit")
    btnSubmit.disabled = true
    const inputText = document.getElementById("name").value
    if (inputText == "") {
        const errorMessage = document.getElementById("errorMessage")
        errorMessage.style.display = "block"
        setTimeout(function () {
            btnSubmit.disabled = false
        }, 4000);
        return
    }

    if (inputText.length > 30) {
        const errorMessage = document.getElementById("errorMessage")
        errorMessage.style.display = "block"
        setTimeout(function () {
            btnSubmit.disabled = false
        }, 4000);
        return
    }

    const registerForm = document.getElementById("form1")

    registerForm.submit()
}