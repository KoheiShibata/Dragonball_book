
// ハンバーガーメニュ表示
$(".hamburger-btn").click(function() {
    const hamburgerBtn = document.getElementById("hamburgerBtn")
    const hamburgerNav = document.getElementById("hamburgerNav")

    hamburgerBtn.classList.toggle("hamburger-btn--active")
    hamburgerNav.classList.toggle("hamburger-nav--active")
});

// ログアウト処理
function onClickLogout() {
    const logoutBtn = document.getElementById("logoutBtn")
    
    let res = confirm("本当にログアウトしますか？")
    if(res == true) {
        document.admin_logout[0].submit();
    }
}