// 二重サブミット対策
function doubleSolutionSubmit() {
  const btnSubmit = document.getElementById("btnSubmit")
  const searchForm = document.getElementById("search-form")

  btnSubmit.disabled = true
  searchForm.submit()
}