"use strict";

$(function () {
  //==================================================================
  var lazyLoadInstance = new LazyLoad({
    elements_selector: ".lazy"
  });
  /* if (lazyLoadInstance) {
  	lazyLoadInstance.update();
  } */
  //==================================================================

  $('#my-menu').mmenu({
    extensions: {
      "all": ['theme-white', 'effect-menu-slide', "multiline", 'pagedim-black', 'position-right'] // "(max-width: 480px)": ['fullscreen']

    },
    navbar: {
      title: "<img src='img/logo.png' alt>"
    }
  });
  var api = $("#my-menu").data("mmenu");
  api.bind('open:finish', function () {
    $('.main-header__mbtn').addClass('active');
  });
  api.bind('close:finish', function () {
    $('.main-header__mbtn').removeClass('active');
  }); //==================================================================

  /* const swiper = new Swiper('.swiper', {
  	// Optional parameters
  	direction: 'vertical',
  	loop: true,
  		// If we need pagination
  	pagination: {
  		el: '.swiper-pagination',
  	},
  		// Navigation arrows
  	navigation: {
  		nextEl: '.swiper-button-next',
  		prevEl: '.swiper-button-prev',
  	},
  		// And if we need scrollbar
  	scrollbar: {
  		el: '.swiper-scrollbar',
  	},
  	breakpoints: {
  		// when window width is >= 320px
  		320: {
  			slidesPerView: 2,
  			spaceBetween: 20
  		},
  		// when window width is >= 480px
  		480: {
  			slidesPerView: 3,
  			spaceBetween: 30
  		},
  		// when window width is >= 640px
  		640: {
  			slidesPerView: 4,
  			spaceBetween: 40
  		}
  	}
  }); */
  //==================================================================

  var swProds = new Swiper('.prods-sect__slider .swiper', {
    loop: true,
    navigation: {
      nextEl: '.prods-sect__slider-next',
      prevEl: '.prods-sect__slider-prev'
    },
    breakpoints: {
      220: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      400: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      480: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 15
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 10
      },
      1420: {
        slidesPerView: 4,
        spaceBetween: 20
      }
    }
  }); //==================================================================

  var swDist = new Swiper('.dist-sect__slider .swiper', {
    loop: true,
    speed: 600,
    autoplay: {
      delay: 4000
    },
    breakpoints: {
      220: {
        slidesPerView: 'auto',
        spaceBetween: 40
      },
      480: {
        slidesPerView: 'auto',
        spaceBetween: 40
      },
      576: {
        slidesPerView: 'auto',
        spaceBetween: 40
      },
      768: {
        slidesPerView: 'auto',
        spaceBetween: 40
      },
      992: {
        slidesPerView: 'auto',
        spaceBetween: 50
      },
      1200: {
        slidesPerView: 'auto',
        spaceBetween: 50
      },
      1420: {
        slidesPerView: 'auto',
        spaceBetween: 50
      }
    }
  }); //==================================================================

  var swNews = new Swiper('.news-sect__slider .swiper', {
    loop: true,
    navigation: {
      nextEl: '.news-sect__slider-next',
      prevEl: '.news-sect__slider-prev'
    },
    breakpoints: {
      220: {
        slidesPerView: 'auto',
        spaceBetween: 10
      },
      480: {
        slidesPerView: 'auto',
        spaceBetween: 10
      },
      576: {
        slidesPerView: 'auto',
        spaceBetween: 10
      },
      768: {
        slidesPerView: 'auto',
        spaceBetween: 15
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 20
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 10
      },
      1420: {
        slidesPerView: 4,
        spaceBetween: 20
      }
    }
  }); //==================================================================

  var swTCard = new Swiper(".card-sect__tslider .swiper", {
    direction: 'vertical',
    speed: 600,
    watchSlidesProgress: true,
    navigation: {
      nextEl: '.card-sect__tslider-next',
      prevEl: '.card-sect__tslider-prev'
    },
    breakpoints: {
      220: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      480: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      576: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      992: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 10
      },
      1420: {
        slidesPerView: 4,
        spaceBetween: 15
      }
    }
  });
  var swCard = new Swiper(".card-sect__slider .swiper", {
    spaceBetween: 10,
    speed: 600,
    thumbs: {
      swiper: swTCard,
      autoScrollOffset: 1
    },
    breakpoints: {
      220: {
        slidesPerView: 'auto',
        spaceBetween: 10
      },
      480: {
        slidesPerView: 'auto',
        spaceBetween: 10
      },
      576: {
        slidesPerView: 'auto',
        spaceBetween: 10
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      992: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      1200: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      1420: {
        slidesPerView: 1,
        spaceBetween: 10
      }
    }
  }); //==================================================================

  $('input[name="phone"]').inputmask({
    "mask": "+7 (999) 999-99-99" //"placeholder": "",
    //"clearMaskOnLostFocus": false

  }); //==================================================================

  /* $(window).scroll(function () {
  	if ($(window).scrollTop() >= $(window).height()) {
  		$('.scroll-up').addClass('active');
  	} else {
  		$('.scroll-up').removeClass('active');
  	}
  });
  $('.scroll-up').click(function () {
  	$('html, body').stop().animate({
  		scrollTop: 0
  	}, 'slow', 'swing');
  }); */
  //==================================================================

  var curScroll = $(window).scrollTop();
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 75) {
      $('.main-header').addClass('sticky');
    } else {
      $('.main-header').removeClass('sticky');
    }

    if (curScroll > scroll) {
      $('.main-header').addClass('slide-down');
    } else {
      $('.main-header').removeClass('slide-down');
    }

    curScroll = scroll;
  }); //==================================================================
  //$('selector').css('height', '').equalHeights();
  //==================================================================

  $('.popup-with-zoom-anim').magnificPopup({
    type: 'inline',
    fixedContentPos: false,
    fixedBgPos: true,
    overflowY: 'auto',
    closeBtnInside: true,
    preloader: false,
    midClick: true,
    removalDelay: 300,
    mainClass: 'my-mfp-zoom-in'
  }); //==================================================================

  /* $('.sw-title').click(function() {
  	$(this).toggleClass('active');
  	$(this).parents('.sw').find('.sw-content').stop().slideToggle(250);
  }); */
  //==================================================================

  $('.cat-sect__item-sw').click(function () {
    $(this).toggleClass('active');
    $(this).prev('.hidden-list').stop().slideToggle(250);
  }); //==================================================================
});