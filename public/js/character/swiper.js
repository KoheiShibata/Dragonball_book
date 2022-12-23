const slideCount = document.getElementsByClassName("swiper-slide").length

if (slideCount <= 1) {
  document.querySelector(".swiper-button-prev").style.visibility ="hidden"
  document.querySelector(".swiper-button-next").style.visibility = "hidden"

}

if (slideCount >= 2) {
  const swiper = new Swiper(".swiper", {
    // ページネーションが必要なら追加
    pagination: {
      el: ".swiper-pagination"
    },
    // ナビボタンが必要なら追加
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false
    },
  });
}
