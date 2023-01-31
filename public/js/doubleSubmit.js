// 二重サブミット対策
function doubleSolutionSubmit() {
  const btnSubmit = document.getElementById("btnSubmit")
  const searchForm = document.getElementById("search-form")

  btnSubmit.disabled = true
  searchForm.submit()
}



// ボタンをローディングに変更
function btnChangeLoading(btnSubmit, loadingGifSubmit) {
  btnSubmit.style.display = "none"
  loadingGifSubmit.className = "common-loading-area__submit--active"
}

// ローディングをボタンに変更
function loadingChangeBtn(btnSubmit, loadingGifSubmit) {
  btnSubmit.style.display = "block"
  loadingGifSubmit.className = "common-loading-area__submit--hide"
}