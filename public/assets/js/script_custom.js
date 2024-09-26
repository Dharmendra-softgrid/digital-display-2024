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
 if($('.home_slider').length > 0){
    $('.home_slider').slick({
      dots: false,
      arrows:false,
      infinite: true,
      loop:true,
      speed: 300,
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
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 2,
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


// $(document).on('click','.drop_togl_inr' ,function(){
//   $(this).toggleClass('on');
//   $(this).next('.sub_menu').slideToggle();
// });
// $(document).click(function(e) {
//   $('li.has_child').not($('li.has_child').has($(e.target))).children('.dropdown-menu').slideUp('200');
// });

// video section start
// $(document).on('click', '.play_icon', function() {
//   var videoUrl = $(this).attr('data-attr');  
//   $('#video_popup').on('shown.bs.modal', function () {
//     $('#video_popup iframe').attr('src', videoUrl);

//   })
// })
// $('#video_popup').on('hidden.bs.modal', function () {
//    var iframe = $("#video_popup iframe");
//     iframe.attr("src", iframe.data("src")); 
// })
// video section end


// timelin inner slides start
// $('.timeline_inner_slider').slick({
//   dots: true,
//   arrows:false,
//   infinite: true,
//   loop:true,
//   speed: 300,
//   slidesToShow: 1,
//   slidesToScroll: 1,
  
// });  
// timelin inner slides end

wow = new WOW(
  {
    animateClass: 'animated',
    offset:       100,
    mobile:       false, 
  }
);
wow.init();









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
        breakpoint: 992,
        settings: {
          arrows: false
        }
      }
    ]
    
  });





    // function animateElements() {
    //   $('.progressbar').each(function () {
    //     var elementPos = $(this).offset().top;
    //     var topOfWindow = $(window).scrollTop();
    //     var percent = $(this).find('.circle').attr('data-percent');
    //     var percentage = parseInt(percent, 10) / parseInt(100, 10);
    //     var animate = $(this).data('animate');
    //     if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
    //       $(this).data('animate', true);
    //       $(this).find('.circle').circleProgress({
    //         startAngle: -Math.PI / 2,
    //         value: percent / 100,
    //         size: 246,
    //         thickness: 16,
    //         emptyFill: "#f2f2f2",
    //         fill: {
    //           color: '#EC1C24',
    //         }
    //       }).on('circle-animation-progress', function (event, progress, stepValue) {
    //         $(this).find('div').text((stepValue*100).toFixed(0) + "%");
    //       }).stop();
    //     }
    //   });
    // }

    // Show animated elements
    // animateElements();
    // $(window).scroll(animateElements);

  // why original page end


  // $('.philoshopy-slider .slider-nav').slick({
  //   slidesToShow: 2,
  //   slidesToScroll: 1,
  //   dots: false,
  //   arrows: false,
  //   centerMode: true,
  //   focusOnSelect: true,
  //   autoplay: true,
  //   responsive: [
  //     {
  //       breakpoint: 767,
  //       settings: {
  //       slidesToShow: 1,
  //       slidesToScroll: 1
  //       }
  //     }
  //   ]
  // }); 


///


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
                              slidesToShow: 3,
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
                     });



// =======


               $(document).ready(function () {
                  $("li.nav-item.main_child a.nav-link.drop_togl_inr").click(function (e) {
                        $(this).next(".second_level_menu").slideToggle();
                      e.preventDefault();
                  });

                 });


// =====

         $('.nav_search').click(function(){alert('hh');
          $('.Search_bar').fadeIn();
        });
        $('.Search_bar a.btn-close').click(function(){
          $('.Search_bar').fadeOut();
        })


// ======================c


    if ($(window).width() < 768) {

       $('.footer_col .ftr_title').click(function(){
        $(this).toggleClass('minus');
        $(this).next('.footer_menu_main').slideToggle();
        $(this).parents('.footer_col').siblings().find('.footer_menu_main').slideUp();
        $(this).parents('.footer_col').siblings().find('h4').removeClass('minus');
      });

//
      

   //
      $('.tabs_container .mobile_title').click(function(){
        $(this).toggleClass('open');
        $(this).next('.tabs_content_block').slideToggle();
        $(this).parents('.tabs_container').parents('.tab-pane').siblings().find('.tabs_content_block').slideUp();
        $(this).parents('.tabs_container').parents('.tab-pane').siblings().find('.mobile_title').removeClass('open');
    });

    // 
       $(".filter h5").click(function(){
         event.stopPropagation();
         $(".filter").toggleClass("open");
       });


    }



// =================




  