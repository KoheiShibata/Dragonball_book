
// ハンバーガーメニュ表示
$(".hamburger-btn").click(function() {
    const hamburgerBtn = document.getElementById("hamburgerBtn")
    const hamburgerNav = document.getElementById("hamburgerNav")

    hamburgerBtn.classList.toggle("hamburger-btn--active")
    hamburgerNav.classList.toggle("hamburger-nav--active")
});

// ログアウト処理
function onClickLogout() {
    Swal.fire({
        text: "本当にログアウトしますか？",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#498DC5',
        cancelButtonColor: '#FFA214',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.isConfirmed) {
            document.admin_logout[0].submit()
        }
      })
}