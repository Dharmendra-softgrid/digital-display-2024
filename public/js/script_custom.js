$(document).ready(function() {
  
// header sticky start
  $(window).scroll(function() {    
      var scroll = $(window).scrollTop();    
      if (scroll >= 220) {
          $(".header_sec").addClass('affix');
      } else {
          $(".header_sec").removeClass('affix');
      }
  });


   $('.header_space').height($('.header_sec').outerHeight());
// header sticky end

// Home slider start
 if($('.top_banner_slider').length > 0){
    $('.top_banner_slider').slick({
      dots: true,
      arrows:true,
      infinite: true,
      loop:true,
       autoplay:true,
      speed: 800,
      autoplaySpeed:1500,
      adaptiveHeight: true,
      slidesToShow: 1,
      slidesToScroll: 1
    });  
  }
// Home slider end



$('.case_studies_slider').slick({
  dots: true,
  arrows:true,
  infinite: true,
  loop:true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 3,
        dots: true,
        arrows:false,
      }
    },

    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        dots: true,
        arrows:false,
      }
    }
  ]
});  


$(document).on('click','.dropdown-menu.sub_menu.second_level_menu .drop_togl_inr' ,function(){
  $(this).toggleClass('on');
  $(this).next('.dropdown-menu.sub_menu.second_level_menu .sub_menu').slideToggle();
});
$(document).click(function(e) {
  $('.dropdown-menu.sub_menu.second_level_menu li.has_child').not($('.dropdown-menu.sub_menu.second_level_menu li.has_child').has($(e.target))).children('.dropdown-menu').slideUp('200');
});

// video section start
$(document).on('click', '.play_icon', function() {
  var videoUrl = $(this).attr('data-attr');  
  $('#video_popup').on('shown.bs.modal', function () {
    $('#video_popup iframe').attr('src', videoUrl);

  })
})
$('#video_popup').on('hidden.bs.modal', function () {
   var iframe = $("#video_popup iframe");
    iframe.attr("src", iframe.data("src")); 
})
// video section end




// wow = new WOW(
//   {
//     animateClass: 'animated',
//     offset:       100,
//     mobile:       false, 
//   }
// );
// wow.init();



$('.digital_slider_banner').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: true,
    infinite: false,
    autoplay: true,
});


$('.slider-for-product').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.product-thumb-image'
});


$('.product-thumb-image').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    vertical:true,
    asNavFor: '.slider-for-product',
    dots: false,
    focusOnSelect: true,
    verticalSwiping:true,
    responsive: [
    {
        breakpoint: 992,
        settings: {
          vertical: false,
        }
    },
    {
      breakpoint: 768,
      settings: {
        vertical: false,
      }
    },
    {
      breakpoint: 580,
      settings: {
        vertical: false,
        slidesToShow: 4,
      }
    },
    {
      breakpoint: 380,
      settings: {
        vertical: false,
        slidesToShow: 3,
      }
    }
    ]
});

// mobile timeline slider end


// $(document).on('click', '.getinspired_list_section .inspired_tab .nav-item .nav-link', function(){
//   var tabAttr = $(this).attr('id');
//   $(this).parent('li').parent('.nav-tabs').attr('data-class',tabAttr)
// });

// why original page start




  $('.product_finder_slider').slick({
    arrows: true,
    dots: false,
    slidesToShow: 2,
    slidesToScroll: 1,
    // infinite: false,
    // autoplay: true,
    speed: 1000,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          arrows: false
        }
      }
    ],
     responsive: [
      {
        breakpoint: 767,
        settings: {
          arrows: false,
          slidesToShow: 1,
        slidesToScroll: 1,
        }
      }
    ]
    
  });



  $('.industries_slider').slick({
    arrows: true,
    dots: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    // infinite: false,
    // autoplay: true,
    speed: 1000,
    responsive: [
      {
        breakpoint:1199,
        settings: {
          arrows: true,
          slidesToShow: 3,
         slidesToScroll: 1,
        }
      },

      {
        breakpoint: 992,
        settings: {
          arrows: false,
          slidesToShow: 2,
         slidesToScroll: 1,
        }
      },

      {
        breakpoint: 767,
        settings: {
          arrows: true,
          slidesToShow: 1,
         slidesToScroll: 1,
        }
      }
    ]
    
  });


  $('.solution_slider').slick({
    arrows: false,
    dots: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    // infinite: false,
    // autoplay: true,
     centerPadding: "300px",
    speed: 1000,
    responsive: [
      {
        breakpoint: 1199,
        settings: {
          arrows: false,
          slidesToShow: 4,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 992,
        settings: {
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
       {
        breakpoint:767,
        settings: {
          arrows: false,
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint:420,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
    
  });

//   function animateElements() {
//     $(".element-to-animate").animate({
//         opacity: 0.5,
//         left: "+=50",
//     }, 1000, function() {
//         // Animation complete.
//     });
// }



    function animateElements() {
      $('.progressbar').each(function () {
        var elementPos = $(this).offset().top;
        var topOfWindow = $(window).scrollTop();
        var percent = $(this).find('.circle').attr('data-percent');
        var percentage = parseInt(percent, 10) / parseInt(100, 10);
        var animate = $(this).data('animate');
        if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
          $(this).data('animate', true);
          $(this).find('.circle').circleProgress({
            startAngle: -Math.PI / 2,
            value: percent / 100,
            size: 246,
            thickness: 16,
            emptyFill: "#f2f2f2",
            fill: {
              color: '#EC1C24',
            }
          }).on('circle-animation-progress', function (event, progress, stepValue) {
            $(this).find('div').text((stepValue*100).toFixed(0) + "%");
          }).stop();
        }
      });
    }

    // Show animated elements
    animateElements();
    $(window).scroll(animateElements);

  // why original page end


$('.dropdown-menu li').on('click', function() {
  var getValue = $(this).text();
  $('.dropdown-select').text(getValue);
});


///

// $('#inner-box').collapse(false);
// $('#inner-box1').collapse(false);


// for load more product



jQuery(function () {
        jQuery(".productItem").slice(0, 6).show();
        jQuery("body").on('click touchstart', '.load-more', function (e) {
            e.preventDefault();
            jQuery(".productItem:hidden").slice(0, 6).slideDown();
            if ($(".productItem:hidden").length == 0) {
                $(".load-more").css('visibility', 'hidden');
            }
            jQuery('html,body').animate({
                scrollTop: $(this).offset().top
            }, 1000);
        });
    });




});  //document.ready end


$(document).ready(function(){
  $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'
  });

  $('.slider-nav').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      // vertical:true,
      asNavFor: '.slider-for',
      dots: false,
      focusOnSelect: true,
      // verticalSwiping:true,
        responsive: [
                  {
                    breakpoint: 767,
                    settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                    }
                  }
                ]
      
  });
  $("li.nav-item.main_child a.nav-link.drop_togl_inr").click(function (e) {
    $(this).next(".second_level_menu").slideToggle();
    e.preventDefault();
  });

  $('.nav_search').click(function(){
    $('.Search_bar').fadeIn();
  });

  $('.Search_bar a.btn-close').click(function(){
    $('.Search_bar').fadeOut();
  })
 

  $('.boxselect').change(function(){
    $this = $(this);
    $('.select-box').hide();
    $('.'+$this.val()).show();
    console.log("showing "+$this.val()+" boxes");
  });

  
});
$(document).ready(function(){

  if ($(window).width() < 768) {
    $('.footer_col .ftr_title').click(function(){
      $(this).toggleClass('minus');
      $(this).next('.footer_menu_main').slideToggle();
      $(this).parents('.footer_col').siblings().find('.footer_menu_main').slideUp();
      $(this).parents('.footer_col').siblings().find('.ftr_title').removeClass('minus');
    });

    $('.tabs_container .mobile_title').click(function(){
        $(this).toggleClass('open');
        $(this).next('.tabs_content_block').slideToggle();
        $(this).parents('.tabs_container').parents('.tab-pane').siblings().find('.tabs_content_block').slideUp();
        $(this).parents('.tabs_container').parents('.tab-pane').siblings().find('.mobile_title').removeClass('open');
    });

    $(".filter h5").click(function(){
      event.stopPropagation();
      $(".filter").toggleClass("open");
    });
    
  }
});








                


