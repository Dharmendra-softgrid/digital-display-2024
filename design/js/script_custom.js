$(document).ready(function() {
  $('.homeslider_main').slick({
    dots: true,
    arrows:false,
    infinite: true,
    loop:true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
  	autoplaySpeed: 3000,
  });  
  // home slider end

  $('.search_toggle_btn').click(function() {
      $('.search_form_main').toggleClass('open');
  });

  $('.fancybox-video').fancybox({
    maxWidth: 760,
    maxHeight: 420,
    fitToView: true,
    width: '100%',
    height: '100%',
    autoSize: true,
    openEffect: 'fade',
    closeEffect: 'fade'
  });

  $('.video-slider').slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow:2,
    autoplay: true,
    slidesToScroll:1,
    autoplaySpeed: 5000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
            slidesToShow: 1,
            dots: false,
            arrows: true
        }
      },
      {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            dots: false,
            arrows: true
        }
      }
    ]
  });

  $('.indus-slider').slick({
    dots: false,
    arrows: true,
    infinite: true,
    slidesToShow:4,
    autoplay: true,
    slidesToScroll:1,
    autoplaySpeed: 5000,
    responsive: [
      {
        breakpoint: 768,
        settings: {
            slidesToShow: 2,
            dots: false,
            arrows: true
        }
      },
      {
        breakpoint: 480,
        settings: {
            slidesToShow: 2,
            dots: false,
            arrows: true
        }
      }
    ]
  });

  $('.product_slider_main').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots:false,
        fade: true,
        asNavFor: '.product_slider_thumb'
    });
    $('.product_slider_thumb').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.product_slider_main',
        dots: false,
        arrows:true,
        focusOnSelect: true
    });

    $('.product_list_main ').slick({
      dots: true,
      arrows: false,
      infinite: true,
      slidesToShow:2,
      autoplay: true,
      slidesToScroll:1,
      autoplaySpeed: 3000,
    });

    $('.video_slider').slick({
      dots: true,
      arrows: false,
      infinite: true,
      slidesToShow:1,
      autoplay: true,
      slidesToScroll:1,
      autoplaySpeed: 3000,
    });
    
});  //document.ready end