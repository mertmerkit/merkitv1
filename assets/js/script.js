var swiper = new Swiper(".AdSlider", {
     slidesPerView: 1,
     spaceBetween: 30,
     loop: true,
     pagination: {
       el: ".swiper-pagination",
       clickable: true,
     },
     autoplay: {
          delay: 1322500,
          disableOnInteraction: false,
     },
     navigation: {
       nextEl: ".swiper-button-next",
       prevEl: ".swiper-button-prev",
     },
   });

   
  var swiper = new Swiper(".calendarSwiper", {
    slidesPerView: 3,
    spaceBetween: 10,
    loop: false,
    pagination: {
      el: ".swiper-paginations",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });


   var swiper = new Swiper(".RecommendSlider", {
    slidesPerView: 5.2,
    spaceBetween: 25,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      1900: { slidesPerView: 5.2},
      1600: { slidesPerView: 5.2},
      1200: { slidesPerView: 4.7},
      1024: { slidesPerView: 4.2},
      768: { slidesPerView: 3.9, spaceBetween: 25},
      640: { slidesPerView: 3.3},
      500: { slidesPerView: 2.7},
      370: { slidesPerView: 2, spaceBetween: 20},
      320: { slidesPerView: 1.7, spaceBetween: 15},
    },
    autoplay: {
         delay: 1322500,
         disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

  });

  var swiper = new Swiper(".AdSliderMobile", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
         delay: 1322500,
         disableOnInteraction: false,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });




 