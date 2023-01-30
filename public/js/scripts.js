$(document).ready(function(){  

  jcf.replaceAll();

  $('.search-ico').click(function (e) {
    e.preventDefault(e);
    $(this).parents('.search').addClass('search-open');
  });
  $('.search .close').click(function (e) {
    e.preventDefault(e);
    $(this).parents('.search').removeClass('search-open');
  });

  $('.nav-ico').click(function (e) {
    e.preventDefault(e);
    $('body').toggleClass('js-open');
  });

  $('.f-title').click(function (e) {
    e.preventDefault(e);
    $(this).parents('.f-col').toggleClass('col-open');
  });


  var swiper = new Swiper(".review-01", {
    slidesPerView: 1,
    spaceBetween: 24,
    pagination: {
      el: ".review-01-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".review-next01",
      prevEl: ".review-prev02",
    },
    breakpoints: {      
      768: {
        slidesPerView: 2,        
      },
      1024: {
        slidesPerView: 3,        
      },
    },
  });

  var swiper = new Swiper(".review-02", {
    slidesPerView: 1,
    spaceBetween: 24,
    pagination: {
      el: ".review-02-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".review-next02",
      prevEl: ".review-prev02",
    },
    breakpoints: {      
      768: {
        slidesPerView: 2,        
      },
      1024: {
        slidesPerView: 3,        
      },
    },
  });


});

