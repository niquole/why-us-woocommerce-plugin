const swiper = new Swiper('.whyus-slider', {
  loop: true,
  spaceBetween: 20,

  slidesPerView: 1,

  breakpoints: {
    640: {
      slidesPerView: 1
    },
    768: {
      slidesPerView: 2
    },
    1024: {
      slidesPerView: 4
    }
  }
});