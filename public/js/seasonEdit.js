// シーズン名編集
window.addEventListener('DOMContentLoaded', () => {

    const editSubmit = document.getElementById("editSubmit")

    editSubmit.addEventListener("click", (e) => {
        const name = document.getElementById("modal_name").value
        const editId = document.getElementById("modal_editId").value
        const errorMessage = document.getElementById("modalSeasonErrorMessage")
        editSubmit.disabled = true

        if (name == "") {
            errorMessage.style.display = "block"
            setTimeout(function () {
                editSubmit.disabled = false
            }, 4000);
            return
        }

        if (name.length > 30) {
            errorMessage.style.display = "block"
            setTimeout(function () {
                btnSubmit.disabled = false
            }, 4000);
            return
        }

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: `/season_edit/${editId}`,
            type: "POST",
            data: { name: name }
        })
            // Ajaxリクエストが成功した時発動
            .done((data) => {
                window.location.href = ("/seasons")
            })
            // Ajaxリクエストが失敗した時発動
            .fail((data) => {
                btnSubmit.disabled = false
                Swal.fire({
                    icon: 'error',
                    text: '登録に失敗しました',
                })
            })
        // Ajaxリクエストが成功・失敗どちらでも発動


    }, false);

}, false);