var swiper = new Swiper(".banner", {
  slidesPerView: 1,
  effect: "fade",
  loop: true,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".dot-swiper-pagination",
    clickable: true,
  },
});

var swiper = new Swiper(".blog-slider", {
  slidesPerView: 3,
  spaceBetween: 30,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    576: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

var swiper = new Swiper(".product-slider", {
  slidesPerView: 4,
  spaceBetween: 30,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 15,
    },
    640: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
    1920: {
      slidesPerView: 4,
    },
  },
});

var related = new Swiper(".product-slider-related", {
  slidesPerView: 5,
  spaceBetween: 20,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  loop: true,
  navigation: {
    prevEl: ".related-button",
    nextEl: ".related-button",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 5,
    },
    1920: {
      slidesPerView: 5,
    },
  },
});

var hero = new Swiper(".hero", {
  direction: "vertical",
  autoHeight: true,
  effect: "fade",
  mousewheel: true,
  loop: true,
  // autoplay: {
  //   delay: 3000,
  //   disableOnInteraction: false,
  // },
  pagination: {
    el: ".fashion-swiper-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + (index + 1) + "</span>";
    },
  },
});

var swiper = new Swiper(".top-product", {
  slidesPerView: 3,
  spaceBetween: 30,
  // mousewheel: true,
  loop: true,
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 30,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    1240: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
    1920: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
  },
});

var swiper = new Swiper(".instagram", {
  slidesPerView: 5,
  // mousewheel: true,
  loop: true,
  breakpoints: {
    0: {
      slidesPerView: 2,
    },
    640: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 6,
    },
    1240: {
      slidesPerView: 7,
    },
    1920: {
      slidesPerView: 7,
    },
  },
});

var swiper = new Swiper(".instagram-two", {
  slidesPerView: 5,
  // mousewheel: true,
  loop: true,
  breakpoints: {
    0: {
      slidesPerView: 2,
    },
    640: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 4,
    },
    1240: {
      slidesPerView: 6,
    },
    1920: {
      slidesPerView: 6,
    },
  },
});

var swiper = new Swiper(".left-sidebar", {
  slidesPerView: 1,
  mousewheel: true,
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
});

var swiper = new Swiper(".product-slide-small", {
  // loop: true,
  spaceBetween: 10,
  // centeredSlides: true,
  loop: true,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    0: {
      slidesPerView: 3,
      direction: "horizontal",
    },
    770: {
      slidesPerView: 5,
      direction: "horizontal",
    },
    991: {
      slidesPerView: 4,
      direction: "horizontal",
    },
    1140: {
      slidesPerView: 4,
      direction: "horizontal",
    },
    1200: {
      direction: "vertical",
      slidesPerView: 4,
    },
    1400: {
      direction: "vertical",
      slidesPerView: 4,
    },
    1920: {
      direction: "vertical",
      slidesPerView: 6,
    },
  },
});

var swiper2 = new Swiper(".product-slide-big", {
  loop: true,
  spaceBetween: 10,
  loop: true,
  thumbs: {
    swiper: swiper,
  },
});

var swiper = new Swiper(".product-slide-small-bottom", {
  spaceBetween: 10,
  loop: true,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    0: {
      slidesPerView: 4,
    },
    768: {
      slidesPerView: 6,
    },
    991: {
      slidesPerView: 4,
    },
    1140: {
      slidesPerView: 4,
    },
    1200: {
      slidesPerView: 5,
    },

    1500: {
      slidesPerView: 6,
    },
  },
});

var swiper2 = new Swiper(".product-slide-big-bottom", {
  spaceBetween: 10,
  loop: true,
  thumbs: {
    swiper: swiper,
  },
});

var swiper = new Swiper(".product-no-thumb", {
  slidesPerView: 1,
  spaceBetween: 30,
  effect: "fade",
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  loop: true,
});

// zoom effect on mouse //

function zoom(e) {
  var zoomer = e.currentTarget;
  e.offsetX ? (offsetX = e.offsetX) : (offsetX = e.touches[0].pageX);
  e.offsetY ? (offsetY = e.offsetY) : (offsetX = e.touches[0].pageY);
  x = (offsetX / zoomer.offsetWidth) * 100;
  y = (offsetY / zoomer.offsetHeight) * 100;
  zoomer.style.backgroundPosition = x + "% " + y + "%";
}

var swiper = new Swiper(".brand", {
  slidesPerView: 4,
  loop: true,
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },

    425: {
      slidesPerView: 2,
      spaceBetween: 18,
    },

    640: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    1240: {
      slidesPerView: 5,
      spaceBetween: 30,
    },
    1920: {
      slidesPerView: 5,
      spaceBetween: 30,
    },
  },
});

var swiper = new Swiper(".categories-swiper", {
  slidesPerView: 4,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-seller-next",
    prevEl: ".swiper-seller-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    575: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
  },
});

var swiper = new Swiper(".categories-inline", {
  slidesPerView: 4,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-seller-next",
    prevEl: ".swiper-seller-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    575: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    767: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    991: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
  },
});

var swiper = new Swiper(".categories-slider-box", {
  slidesPerView: 4,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-seller-next",
    prevEl: ".swiper-seller-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
  },
});

var swiper = new Swiper(".categories-product-slider", {
  slidesPerView: 3,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-seller-next",
    prevEl: ".swiper-seller-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    767: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 3,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 3,
      spaceBetween: 24,
    },
  },
});

var swiper = new Swiper(".categories-swiper-six", {
  slidesPerView: 4,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-seller-next",
    prevEl: ".swiper-seller-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    575: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    768: {
      slidesPerView: 5,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 6,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 6,
      spaceBetween: 24,
    },
  },
});

var swiper = new Swiper(".categories-like", {
  slidesPerView: 4,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".viewed-product-2",
    prevEl: ".viewed-product-2",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
  },
});

var categories = new Swiper(".categories-round-slider", {
  slidesPerView: 4,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    576: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 18,
    },
    1050: {
      slidesPerView: 5,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
    1490: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
    1491: {
      slidesPerView: 6,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 7,
      spaceBetween: 24,
    },
  },
});

var testimonialSwiper = new Swiper(".testimonial-swiper", {
  slidesPerView: 4,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  navigation: {
    nextEl: ".swiper-testimonial-next",
    prevEl: ".swiper-testimonial-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    1240: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1920: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});

var swiper = new Swiper(".full-product-slide", {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 1.5,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    776: {
      slidesPerView: 1.5,
      spaceBetween: 18,
    },
    991: {
      slidesPerView: 1.5,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 2,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 2,
      spaceBetween: 24,
    },
  },
});
var swiper2 = new Swiper(".full-product-slide2", {
  loop: true,
  spaceBetween: 10,
  thumbs: {
    swiper: swiper,
  },
});

var swiper = new Swiper(".blog-detail", {
  slidesPerView: 1,
  spaceBetween: 10,
  // mousewheel: true,
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
});

var Team = new Swiper(".team-slider", {
  slidesPerView: 4,
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    1814: {
      slidesPerView: 3,
      spaceBetween: 18,
    },

    1240: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 5,
      spaceBetween: 24,
    },
  },
});

var Team = new Swiper(".tab-slide", {
  slidesPerView: 4,
  spaceBetween: 30,
  centeredSlides: true,
  loop: true,
  // autoplay: {
  //   delay: 5000,
  //   disableOnInteraction: false,
  // },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
      centeredSlides: false,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    1240: {
      slidesPerView: 5.2,
      spaceBetween: 24,
    },
    1920: {
      slidesPerView: 5.2,
      spaceBetween: 24,
    },
  },
});

var ShopSlider = new Swiper(".shop-banner-slider", {
  slidesPerView: 1,
  effect: "fade",
  loop: true,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".dot-swiper-pagination",
    clickable: true,
  },
});

var BlogSlider = new Swiper(".blog-slider-zoom", {
  spaceBetween: 20,
  slidesPerView: 3,
  loop: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    576: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 24,
    },
  },
});

var swiper = new Swiper(".banner-sidearrow", {
  slidesPerView: 1,
  loop: true,
  effect: "fade",
  // mousewheel: true,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var swiper = new Swiper(".full-slide", {
  loop: true,
  spaceBetween: 24,
  freeMode: true,
  watchSlidesProgress: true,

  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 18,
    },
    576: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    767: {
      slidesPerView: 3,
      spaceBetween: 18,
    },
    768: {
      slidesPerView: 2.7,
      spaceBetween: 24,
    },
    1024: {
      slidesPerView: 2.7,
      spaceBetween: 24,
    },
  },
});
var swiper2 = new Swiper(".full-slide_2", {
  loop: true,
  effect: "fade",
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});

var swiper = new Swiper(".view", {
  loop: true,
  spaceBetween: 10,
  slidesPerView: 3,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".view2", {
  loop: true,
  spaceBetween: 10,
  navigation: {
    nextEl: ".swiper-view-next",
    prevEl: ".swiper-view-prev",
  },
  thumbs: {
    swiper: swiper,
  },
});
var swiper = new Swiper(".header-slider", {
  slidesPerView: 4,
  spaceBetween: 15,
  loop: true,
});
var swiper = new Swiper(".demo-1-slider", {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 3,
  watchSlidesProgress: true,
  breakpoints: {
    0: {
      spaceBetween: 15,
    },
    767: {
      spaceBetween: 30,
    },
  },
});
var swiper2 = new Swiper(".demo-1-slider-2", {
  loop: true,
  effect: "fade",
  spaceBetween: 10,
  thumbs: {
    swiper: swiper,
  },
});
