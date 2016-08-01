jQuery(function ($) {

  // Some browser sniffing (used later [not ideal, but needed])
  var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
  var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
  var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
  var is_safari = navigator.userAgent.indexOf("Safari") > -1;
  var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
  if ((is_chrome)&&(is_safari)) {is_safari=false;}
  if ((is_chrome)&&(is_opera)) {is_chrome=false;}

  $(window).load(function() {
    $('html').removeClass('preload');
  });

  var slideout = new Slideout({
      'panel': document.getElementById('wrapper'),
      'menu': document.getElementById('mobile-menu'),
      'padding': 256,
      'tolerance': 70,
      'side': 'right'
  });

  $('.super-header-mobile').on('click', function ( evt ) {
      slideout.toggle();
  });

  $('#mobile-menu-button').click(function ( ) {
		$(this).toggleClass('open');
    console.log('clicked');
	});

  $('#mobile-menu .menu-item-has-children').on('click', function( evt ) {
      $(this).toggleClass('open');
      evt.preventDefault();
  });

  /* Slick Slider --------------*/
  $('.bg-slideshow').slick({
    infinite:true,
    autoplay: true,
    fade: true,
    arrows: false,
    autoplaySpeed: 4000
  });

  $('.home-hero-slides').slick({
    infinite:true,
    autoplay: true,
    arrows: false,
    pauseOnHover: false,
    speed: 1500,
    autoplaySpeed: 8000,
    useTransform: true,
    dots: true,
    cssEase: 'cubic-bezier(.77,.01,.45,1)'
  });

  /* Sub-menu triggers ----------------*/




  var createTrigger = function ( trigger, responder ) {

    var hover_timeout = 150; // milliseconds
    var is_hovered = false;

    function hideElement(waitTime)
    {
        setTimeout(function()
        {
            if (!is_hovered)
            {
              $(responder).removeClass('active');
              $(trigger).removeClass('active');
            }
        },waitTime);
    }
    function showElement()
    {
        setTimeout(function()
        {
            if (is_hovered)
            {
              $(responder).addClass('active');
              $(trigger).addClass('active');

            }
        },500);
    }

    var trigger_mouseenter = function ( evt ) {
      // $(responder).addClass('active');
      // $(trigger).addClass('active');
      // is_hovered = true;
      showElement();
      is_hovered = true;
    };

    var trigger_mouseleave = function ( evt ) {
      hideElement(hover_timeout);
      is_hovered = false;
    };

    var response_mouseenter = function ( evt ) {
      is_hovered = true;
    };

    var response_mouseleave = function ( evt ) {
      hideElement(hover_timeout);
      is_hovered = false;
    };

    $(trigger).click(function( event ){
      event.preventDefault();
    });
    $(trigger).on('mouseenter', trigger_mouseenter);
    $(trigger).on('mouseleave', trigger_mouseleave);
    $(responder).on('mouseenter', response_mouseenter);
    $(responder).on('mouseleave', response_mouseleave);
  };

  createTrigger('.about-menu-trigger', '.about-sub-nav');
  createTrigger('.work-menu-trigger', '.work-sub-nav');



  var scrollTrigger = function() {
    $('.scroll-trigger').each(function(i, elm) {
      var screenBottom = $(window).scrollTop() + $(window).height();
      var buffer = 0;
      var target = $(elm).offset().top + buffer;
      var animated = $(elm).hasClass('active');

      if (screenBottom >= target) {
        if (!animated) {
          $(elm).addClass('active');
        }
      }
    });
  };

  var svgDraw = function() {
    $('.svg-draw').each(function(i, elm) {
      var screenBottom = $(window).scrollTop() + $(window).height();
      var buffer = 0;
      var target = $(elm).offset().top + buffer;
      var lineLength = $(elm).attr('stroke-length');

      if (screenBottom >= target) {
        // this relies on the pre-calculating done in svg.js
        $(elm).css('stroke-dashoffset', (lineLength * 2));
      }
    });
  };
  $(window).load(function() {
    if($(window).width() > 767){
      svgDraw();
      scrollTrigger();
    }
  });
  $(window).on('scroll', function() {
    if($(window).width() > 767){
      svgDraw();
      scrollTrigger();
    }
  });


  // When the DOM is ready
  // $(function() {
  $(window).load(function() {

    // Init ScrollMagic Controller
    var scrollMagicController = new ScrollMagic.Controller();

    // ------ Page Hero Animations
    var pageHero = $('#page-hero');
    var heroHeight = pageHero.outerHeight();
    $(window).on('resize', function(){
      var heroHeight = pageHero.outerHeight();
    });

    // ------- Create Animation for Hero Section parallax
    var tween = TweenMax.to('#page-hero .hero-bg', 0.5, {
      y: heroHeight * 0.4,
      ease: Linear.easeNone
    });

    // Create the Scene and trigger when visible
    var scene = new ScrollMagic.Scene({
      triggerElement: '#page-hero',
      duration: heroHeight,
      triggerHook: 0 // trigger using the top of viewport
    })
    .setTween(tween)
    .addTo(scrollMagicController);

    // ------- Activate scroll animations
    // $(function() {
    //   $(".scroll-trigger").each(function (index, elem) {
    //
    //     new ScrollMagic.Scene({
    //       duration: 0,
    //       triggerElement: elem,
    //       triggerHook: 0.9
    //     })
    //     .setClassToggle(elem, "active") // add class toggle
    //     .addTo(scrollMagicController);
    //   });
    // });

    // ------- Activate scroll animations
    // $(function() {
    //   $(".svg-draw").each(function (index, elem) {
    //
    //     lineLength = $(elem).attr('stroke-length');
    //
    //     new ScrollMagic.Scene({
    //       duration: 0,
    //       triggerElement: elem,
    //       triggerHook: 0.9
    //     })
    //
    //     .setClassToggle(elem, "active") // add class toggle
    //     .css('stroke-dashoffset', lineLength)
    //     .addTo(scrollMagicController);
    //   });
    // });



    // ------- Billboard parallax
    $(".billboard").each(function () {

      var elemBg = $(this).find('.billboard-bg');

      new ScrollMagic.Scene({
        triggerElement: this,
        duration: "200%",
        triggerHook: 1 // trigger using the top of viewport
      })
      .setTween(elemBg, {y: "40%", ease: Linear.easeNone})
      .addTo(scrollMagicController);
    });

    // ------- Case Study
    $(".case-study-cover").each(function () {

      var screenEl = $(this).find('.case-study-cover-screen.scroll-fade');

      new ScrollMagic.Scene({
        triggerElement: this,
        duration: "300",
        triggerHook: 0.5
      })
      .setTween(screenEl, {opacity: "0.2", ease: Linear.easeNone})
      .addTo(scrollMagicController);
    });

  });

  // -------- Expanding Content
  $('.a_show').click(function( event ){
    event.preventDefault();
    $(this).closest('.expanding-content').addClass('active');
  });
  $('.a_hide').click(function( event ){
    event.preventDefault();
    $(this).closest('.expanding-content').removeClass('active');
  });

  // ------- Magnific Popup
  // $('.modal-image').magnificPopup({
  //   type:'image',
  //   removalDelay: 500 //delay removal by X to allow out-animation
  // });

  $('.image-gallery').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        removalDelay: 500, //delay removal by X to allow out-animation
        mainClass: 'modal-image',
        gallery: {
          enabled:true
        },
        image: {
          titleSrc: function(item) {
            return item.el.attr('data-caption');
          },
          tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        },
        // trying to show image and caption in the window size... this code is not yet working
        callbacks: {
          resize: function() {
              var img = this.content.find('img');
              var captionHeight = this.content.find('.mfp-bottom-bar').outerHeight();
              img.css({
                'max-height': parseFloat(img.css('max-height')) - (captionHeight + 20)
                // 'margin-top': '-' + (captionHeight * 0.5) + 'px'
              });
          },
          open: function() {
            // This code works on resize, but not on initial load.. need to fix this
            var img = this.content.find('img');
            var captionHeight = this.content.find('.mfp-bottom-bar').outerHeight();
            img.css('max-height', parseFloat(img.css('max-height')) - captionHeight);
          },
          change: function() {
            var img = this.content.find('img');
            var captionHeight = this.content.find('.mfp-bottom-bar').outerHeight();
            img.css({
              'max-height': parseFloat(img.css('max-height')) - (captionHeight + 20)
              // 'margin-top': '-' + (captionHeight * 0.5) + 'px'
            });
          }
        }
    });
  });


  $('.lightbox-inline').each(function() {
    var targetElement = $(this).attr('href');
    $(this).magnificPopup({
      type: 'inline',
      removalDelay: 500, //delay removal by X to allow out-animation
      callbacks: {
        beforeOpen: function() {

          // as we open the lightbox, initialize this particular slider
          $(targetElement).find('.lightbox-slideshow').slick({
            infinite: true,
            dots: true,
            arrows: false,
            lazyLoading: 'ondemand',
            customPaging : function(slider, i) {
                var thumb = $(slider.$slides[i]).find('img').data('thumb');
                return '<a><img src="'+thumb+'"></a>';
            }
          });
          $(window).trigger('resize'); // needed to calculate slide dimensions

        },
        afterClose: function() {

          // kill the slider
          $(targetElement).find('.lightbox-slideshow').slick('unslick');

        }
      }
    });
  });

  // $(document).ready(function(){
  //   $('.lightbox-slideshow').each(function(){
  //     $(this).slick({
  //       infinite: true
  //     });
  //   });
  // });



  /*
    GS Infinite Scroll

    Click-activated infinite scroll based on WP pagination
  */

  // Define Vars

  var loadButton = '.main-blog-pagination-next a'; // Button to load more posts

  var blogElem = '.blog-excerpt-wrap'; // Individual blog item selector

  var loadLocation = '.main-blog-list'; // Where to put the blog items

  var loadingContent = '<div class="h3 text-center clr-floats">Loading</div>'; // Content to show while loading

  var noMorePosts = '<div class="h5 text-center vpadding-sm clr-floats">No more posts to display</div>'; // What to show when we run out of posts

  // and now... We start the magic
  var current_page = 1;
  $(loadButton).on('click', function ( evt ) {
    evt.preventDefault();
    evt.stopPropagation();

    // hide the load more button and append the loading indicator
    $(loadButton).hide();
    $(loadLocation).append('<div class="loading-indicator">'+ loadingContent +'</div>');

    // paginate
    current_page++;

    // run the ajax
    $.ajax({
      url: '/blog/page/' + current_page,
      success: function ( result ) {
        var items = $(result).find(blogElem);
        $(items).hide().appendTo(loadLocation).fadeIn(600);
        $('.loading-indicator').remove();

        // if we are great success, then we need to know wether to show the 'load more'
        // button or the 'no more posts' message, so we do one more ajax call to see.
        $.ajax({
          url: '/blog/page/' + (current_page + 1),
          success: function ( result ) {

            var items = $(result).find(blogElem);
            if ( items.length ) {
              // if we do have more content, show the load button
              // (I am using a notrans class to suppress conflicting css transition during fadein)
              $(loadButton).addClass('notrans').fadeIn(600, function(){
                $(loadButton).removeClass('notrans');
              });
            }

          },
          error: function(){
            // if we are outta the goods, show the 'no more posts' message
            $(loadLocation).append(noMorePosts);
          }
        });

      }
    });
  });


  /* Handling of direct download buttons */
  if($('.direct-download-btn').length){
    $('.direct-download-btn').each(function(){
      var thisBtn = $(this);

      $(thisBtn).on('click', function(e){
        e.preventDefault();
        // check for download hidden field
        var hasDownload = $(thisBtn).attr('href');
        if(typeof hasDownload !== typeof undefined && hasDownload !== false){
          // hasDownload = $(thisBtn).attr('href');
          console.log('should donload');
          window.open(funcData.theme_url + '/inc/download.php?d=' + hasDownload);
        }
      });
    });
  }

  /* General handling script for AJAX forms */
  if($('.ajax-form').length) {

    $('.ajax-form').each(function(index){

      var form = this;
      var thisForm = $(this);
      var thisFormBtn = $(this).find(':submit');
      var thisFormWrap = $(this).closest('.ajax-form__wrap');

      $(thisForm).validate({
        rules: {
          contactEmail: {
            required: true,
            email: true
          }
        }
      });

      $(thisFormBtn).on('click', function(e){

        // if(ajaxFormData.doc_url !== null){
        //   // check if this works
        //   console.log('list id' + ajaxFormData.doc_url);
        // }

        if($(thisForm).valid()) {
          e.preventDefault();

          $(thisFormWrap).addClass('submitted processing');


          // Passing 'form' as vanilla js object so we can get all the fields, and not have to grab them each one by name
          var formdata = new FormData(form);

          // var formdata = new FormData();
          // if($(thisForm).find('.form-interests').length){
          //
          //   // get interests and make array
          //   var interestVals = [];
          //
          //   $(thisForm).find('.form-interests').each(function(){
          //     interestVals.push($(this).val());
          //   });
          //
          //   formdata.append('interests', interestVals);
          // }
          // formdata.append('mce-FNAME', $(thisForm).find('#mce-FNAME').val());
          // formdata.append('mce-LNAME', $(thisForm).find('#mce-LNAME').val());
          // formdata.append('mce-EMAIL', $(thisForm).find('#mce-EMAIL').val());
          // if($(thisForm).find('#mce-COMPANY').length){
          //   formdata.append('mce-COMPANY', $(thisForm).find('#mce-COMPANY').val());
          // }

          // check for download hidden field
          var hasDownload = false;
          if($(thisForm).find('#download-item').length){
            hasDownload = $(thisForm).find('#download-item').val();
          }
          if(hasDownload){
            // moved inside the click to start immediately, using file id instead of url for super-secrecy
            window.open(funcData.theme_url + '/inc/download.php?id=' + hasDownload);

          }

          $.ajax({
            url: funcData.theme_url + '/inc/mailchimp-api-v02.php',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formdata,
            success: function(response){
              // console.log('success, you are not crazy');
              console.log(response);
              if(response.httpcode != 200){
                // 200 is success, anything else is an error
                $(thisFormWrap).addClass('submit-error');
              } else {
                // must be successfull
                $(thisFormWrap).addClass('submit-success');

                // if(hasDownload){ - moved to click event to avoid popup blockers
                //
                //   setTimeout(function(){
                //     var x = window.open('http://www.goldenspiralmarketing.com/docs/download.php?d=' + hasDownload);
                //   }, 3000);
                //   // if ( x === undefined ) {
                //   //   alert('Please disable Pop-up Blocking in your browser.');
                //   //   $('.cta.download').click();
                //   // }
                //
                // }

              }
            },
            error: function(response){
              // console.log('error');
              // console.log(response);
              $(thisFormWrap).addClass('submit-error');
            },
            complete: function(response){
              // console.log('complete');
              // console.log(response);
              $(thisForm).find('input[type="text"], input[type="email"]').val('');
              $(thisFormWrap).removeClass('processing').addClass('submit-complete');
            }
          });
        }
      });


      var thisFormDownloadBtn = thisFormWrap.find('.form-download-fallback');

      // manual download button, if user has popups blocked or if auto download fails
      $(thisFormDownloadBtn).on('click', function(e){
        e.preventDefault();
        // check for download hidden field
        var hasDownload = false;
        if($(thisForm).find('#download-item').length){
          hasDownload = $(thisForm).find('#download-item').val();
          var x = window.open(funcData.site_url + '/inc/download.php?d=' + hasDownload);
        }
      });

    });

  }


  /* Animated Form ---------------------*/
  if($('.animated-form').length) {
    $(document).ready(function() {
      setTimeout(function(){
        $(".animated-form .fieldset:first-child").addClass("focus");
        $(".animated-form .fieldset:first-child input").focus();
      }, 1000);
    });
    $(".animated-form input, .animated-form textarea").focus(function() {
      $(this).parent('.fieldset').addClass("focus");
    });
    $(".animated-form input, .animated-form textarea").blur(function() {
      $(this).parent('.fieldset').removeClass("focus");
    });
  }


  /* Case Study Code imported from live site --------------------*/


  // requestAnimationFrame for IE9
	(function() {
			var lastTime = 0;
			var vendors = ['webkit', 'moz'];
			for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
					window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
					window.cancelAnimationFrame =
						window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
			}

			if (!window.requestAnimationFrame)
					window.requestAnimationFrame = function(callback, element) {
							var currTime = new Date().getTime();
							var timeToCall = Math.max(0, 16 - (currTime - lastTime));
							var id = window.setTimeout(function() { callback(currTime + timeToCall); },
								timeToCall);
							lastTime = currTime + timeToCall;
							return id;
					};

			if (!window.cancelAnimationFrame)
					window.cancelAnimationFrame = function(id) {
							clearTimeout(id);
					};
	}());

  function checkSectionSize() {
				var sectionHeight = $('.case-study-section.active').outerHeight();
				$('.case-study-sections').css('min-height', sectionHeight);
			}

  // Need to audit and verify the working of this case study code
  $(document).ready(function() {
  				$('.case-study-gallery-focus').slick({
  					variableWidth: true,
  					slidesToShow: 1,
  					slidesToScroll: 1,
  					arrows: false,
  					// fade: false,
  					dots: true,
  					asNavFor: '.case-study-gallery-monitor-slider .case-study-gallery',
  					centerMode: true,
  					centerPadding: 0,
  					touchThreshold: 12
  				});

  				$('.case-study-gallery-monitor-slider .case-study-gallery').slick({
  					variableWidth: true,
  					slidesToShow: 1,
  					slidesToScroll: 1,
  					asNavFor: '.case-study-gallery-focus',
  					dots: false,
  					arrows: false,
  					centerMode: true,
  					focusOnSelect: true,
  					centerPadding: 0,
  					touchThreshold: 12
  				});

  				$('.case-study-gallery-container:not(.case-study-gallery-monitor-slider) .case-study-gallery').slick({
  					variableWidth: true,
  					slidesToShow: 1,
  					slidesToScroll: 1,
  					dots: true,
  					arrows: false,
  					centerMode: true,
  					focusOnSelect: true,
  					centerPadding: 0,
  					swipeToSlide: true,
  					touchThreshold: 12
  				});


          function checkSectionSize() {
    				var sectionHeight = $('.case-study-section.active').outerHeight();
    				$('.case-study-sections').css('min-height', sectionHeight);
    			}

  				$('.switcher-item').click(function(e) {
  					e.preventDefault();
  					var bg = $('.switcher-bg');
  					var left;

  					if (!$(this).hasClass('active')) {
  						if ($('.switcher-item-text').hasClass('active')) {
  							// left = $(this).closest('.switcher-item-visual').position().left - 3;
  							// bg.css('left', left);
  							// bg.css('left', '49%');
  							console.log('text has active');
  							bg.css('left', '3px');
  							$('.switcher-item-visual').addClass('active');
  							$('.switcher-item-text').removeClass('active');
  							$('.case-study-section.visual').addClass('active');
  							$('.case-study-section.text').removeClass('active');

  							$('.case-study-gallery-focus').slick('setPosition');
  							$('.case-study-gallery').slick('setPosition');
  						} else {
  							// bg.css('left', '3px');
  							bg.css('left', '49%');
  							$('.switcher-item-text').addClass('active');
  							$('.switcher-item-visual').removeClass('active');
  							$('.case-study-section.text').addClass('active');
  							$('.case-study-section.visual').removeClass('active');
  							$('.case-study-banner').removeClass('active');
  							if ($(this).parents('.case-study-banner').length) {
  								$('html, body').animate({
  									scrollTop: 0
  								}, 0);
  							}

  						}
  						checkSectionSize();
  						$(".case-study-gallery").slick('slickGoTo','0', false);
  					}
  				});

  				$('.btn-case-study-more').click(function(e) {
  					e.preventDefault();
  					$('html, body').animate({
  						scrollTop: 0
  					}, 0);
  					if ($(this).hasClass('see')) {
  						$('.switcher-item-visual').click();
  					} else {
  						$('.switcher-item-text').click();
  					}
  					$(".case-study-gallery").slick('slickGoTo','0', false);
  				});




          // Fixed header
				var scrollTop;
				// var activeSection;
				var banner = $('.case-study-banner');
				var activeSection = null;
				var offset = 250;

				$.fn.isOnScreen = function(){
					var win = $(window);

					var viewport = {
						top : win.scrollTop(),
						left : win.scrollLeft()
					};
					viewport.right = viewport.left + win.width();
					viewport.bottom = viewport.top + win.height();

					var bounds = this.offset();
					bounds.right = bounds.left + this.outerWidth();
					bounds.bottom = bounds.top + this.outerHeight();

					return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
				};

				function checkSection() {
					if ($('.case-study-section.visual').hasClass('active')) {
						$('div[data-banner]').each(function() {
							var section = $(this).data('banner');

							if (!section || section === '') {
								return;
							}

							var sectionScrollTop = ( $(this).offset().top - scrollTop ) - offset;

							if (sectionScrollTop <= 0 && $(this).isOnScreen()) {
								activeSection = section;
								if (!banner.hasClass('active')) {
									banner.addClass('active');
								}
								//console.log('section', activeSection);
								if ($('.banner-item.' + activeSection + '.active').length === 0) {
									$('.banner-item').removeClass('active');
									$('.banner-item#' + activeSection).addClass('active');
								}
							} else {
								if (activeSection && activeSection === section) {

									banner.removeClass('active');
									$('.banner-item').removeClass('active');
									activeSection = null;
								}
							}
						});
					}
				}

				$(window).on('scroll', function() {
					scrollTop = $(window).scrollTop();
					window.requestAnimationFrame(checkSection);
				});

				$(window).on('resize', function() {
					window.requestAnimationFrame(checkSectionSize);
				});

  });

  $(window).load(function() {
    checkSectionSize();
  });

  /* End Case Study Code imported from live site --------------------*/



/* Career Form imported from live site -----------*/
if ( $('#career-contact').length ) {
	$('#careerPhone').mask('(999) 999-9999');

    $('#career-submit').on('click', function(e){
      if($('#career-contact').valid()) {
        e.preventDefault();

        var formdata = new FormData();
				formdata.append('careerListing', $('#careerListing').val());
				formdata.append('careerCategory', $('#careerCategory').val());
                formdata.append('careerFirstName', $('#careerFirstName').val());
				formdata.append('careerLastName', $('#careerLastName').val());
				formdata.append('careerEmail', $('#careerEmail').val());
				formdata.append('careerPhone', $('#careerPhone').val());
				formdata.append('careerPortfolio', $('#careerPortfolio').val());
				formdata.append('careerComment', $('#careerComment').val());
				if($('#careerResume').length && $('#careerResume')[0].files.length) {
					var resume = $('#careerResume')[0].files[0];
					formdata.append('careerResume', resume, resume.name);
				}

				$('#career-submit').addClass('disabled');
				$('#career-submit').text('sending...');
				$('#career-submit').prop('disabled', true);

        $.ajax({
            url: funcData.theme_url + '/inc/career-form-apis.php',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formdata
        })
        .done(function(response){
          if(response.status == 'sent') {
						$('#careerFirstName').val('');
						$('#careerLastName').val('');
						$('#careerEmail').val('');
						$('#careerPhone').val('');
						$('#careerPortfolio').val('');
						$('#careerComment').val('');
						$('#careerResume').val('');

						window.location = '/thanks-career';
          }
        });
      }
    });


    $('#career-contact').validate({
        rules: {
            careerEmail: {
                required: true,
                email: true
            }
        },
        messages: {
			careerFirstName: 'required',
			careerLastName: 'required',
            careerEmail: {
                required: 'required',
                email: 'wrong format'
            },
            careerComment: 'required'
        }
    });
}

/* Sticky Elements */
$(window).load(function() {
  $(".sticky").stick_in_parent({
    parent: '.row',
    offset_top: 50
  })
  .on("sticky_kit:bottom", function(e) {
    // console.log("has unstuck!", e.target);
    $(e.target).parent().css('position', 'static');
  })
  .on("sticky_kit:unbottom", function(e) {
    // console.log("has unstuck!", e.target);
    $(e.target).parent().css('position', '');
  });
});




  /* Mouse Follow script from http://stackoverflow.com/questions/3385936/jquery-follow-the-cursor-with-a-div */
  /*
    Works, but needs tweaking. Disabled for now.
  var followEl = $(".hover-highlight");
  var elWidth = followEl.width();
  var elHeight = followEl.height();
  var followWrap = followEl.parent();
  var wrapOffset = followWrap.offset();

  var $mouseX = 0, $mouseY = 0;
  var $xp = 0, $yp =0;

  $(document).mousemove(function(e){
      $mouseX = e.pageX;
      $mouseY = e.pageY;
      console.log('x:' + $mouseX);
      console.log('y:' + $mouseY);
  });

  var $loop = setInterval(function(){
    // change 12 to alter damping higher is slower
    // $xp = ($mouseX - (elWidth * 0.5));
    // $yp = ($mouseY - (elHeight * 0.5));
    $xp = $mouseX - (elWidth * 0.5) - wrapOffset.left;
    $yp = $mouseY - (elHeight * 0.5) - wrapOffset.top;
    followEl.css({left:$xp +'px', top:$yp +'px'});
  }, 30);*/


});

jQuery(function ($) {

  // Some browser sniffing (used later [not ideal, but needed])
  var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
  var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
  var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
  var is_safari = navigator.userAgent.indexOf("Safari") > -1;
  var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
  if ((is_chrome)&&(is_safari)) {is_safari=false;}
  if ((is_chrome)&&(is_opera)) {is_chrome=false;}

  /* SVG Shape measuring tools via http://stackoverflow.com/questions/30355241/get-the-length-of-a-svg-line-rect-polygon-and-circle-tags */
  /**
   * Used to get the length of a rect
   *
   * @param el is the rect element ex $('.rect')
   * @return the length of the rect in px
   */
  getRectLength = function(el){
      var w = el.attr('width');
      var h = el.attr('height');

      return (w*2)+(h*2);
  };

  /**
   * Used to get the length of a Polygon
   *
   * @param el is the Polygon element ex $('.polygon')
   * @return the length of the Polygon in px
   */





  getPolygonLength = function(el){
      var points = el.attr('points');
      points = points.split(" ");
      var x1 = null, x2, y1 = null, y2 , lineLength = 0, x3, y3;
      for(var i = 0; i < points.length; i++){
          var coords = points[i].split(",");
          if(x1 === null && y1 === null){

              if(/(\r\n|\n|\r)/gm.test(coords[0])){
                  coords[0] = coords[0].replace(/(\r\n|\n|\r)/gm,"");
                  coords[0] = coords[0].replace(/\s+/g,"");
              }

              if(/(\r\n|\n|\r)/gm.test(coords[1])){
                  coords[0] = coords[1].replace(/(\r\n|\n|\r)/gm,"");
                  coords[0] = coords[1].replace(/\s+/g,"");
              }

              x1 = coords[0];
              y1 = coords[1];
              x3 = coords[0];
              y3 = coords[1];

          }else{

              // if(coords[0] !== "" && coords[1] !== ""){
              if(!isNaN(coords[0]) && !isNaN(coords[1])){

                  if(/(\r\n|\n|\r)/gm.test(coords[0])){
                      coords[0] = coords[0].replace(/(\r\n|\n|\r)/gm,"");
                      coords[0] = coords[0].replace(/\s+/g,"");
                  }

                  if(/(\r\n|\n|\r)/gm.test(coords[1])){
                      coords[0] = coords[1].replace(/(\r\n|\n|\r)/gm,"");
                      coords[0] = coords[1].replace(/\s+/g,"");
                  }

                  x2 = coords[0];
                  y2 = coords[1];
                  // console.log('x: ' + x2);
                  // console.log('y: ' + y2);

                  lineLength += Math.sqrt(Math.pow((x2-x1), 2)+Math.pow((y2-y1),2));

                  // console.log('line length: ' + lineLength);

                  x1 = x2;
                  y1 = y2;
                  if(i == points.length-2){
                      lineLength += Math.sqrt(Math.pow((x3-x1), 2)+Math.pow((y3-y1),2));
                  }

              }
          }

      }
      return (lineLength * 1.05);

  };

  /**
   * Used to get the length of a line
   *
   * @param el is the line element ex $('.line')
   * @return the length of the line in px
   */
  getLineLength = function(el){
      var x1 = el.attr('x1');
      var x2 = el.attr('x2');
      var y1 = el.attr('y1');
      var y2 = el.attr('y2');
      var lineLength = Math.sqrt(Math.pow((x2-x1), 2)+Math.pow((y2-y1),2));
      return lineLength;

  };

  /**
   * Used to get the length of a circle
   *
   * @param el is the circle element
   * @return the length of the circle in px
   */
  getCircleLength = function(el){
      var r = el.attr('r');
      var circleLength = 2 * Math.PI * r;
      return circleLength;
  };


  /**
   * Used to get the length of the path
   *
   * @param el is the path element
   * @return the length of the path in px
   */
  getPathLength = function(el){
      var pathCoords = el.get(0);
      var pathLength = pathCoords.getTotalLength();
      return pathLength;
  };


  /* SVG Draw Pre-calculations */
  if($('.svg-draw').length){
    $('.svg-draw').each(function(){

      // get length of all svg elements, and assign the largest of each svg's paths to 'length' var... this will be our stroke offset

      var thisSVG = $(this);
      var thisLines;
      if($(this).find('#outlines').length){
        thisLines = $(this).find('#outlines');
      } else {
        thisLines = $(this);
      }
      var length = '';
      thisLines.find('path').each(function(){
        thisLength = Math.ceil(this.getTotalLength());
        if(thisLength > length){
          length = thisLength;
        }
      });
      thisLines.find('rect').each(function(){
        thisLength = Math.ceil(getRectLength($(this)));
        if(thisLength > length){
          length = thisLength;
        }
      });
      thisLines.find('polygon').each(function(){
        // console.log('polygon' + $(this).attr('points'));
        thisLength = Math.ceil(getPolygonLength($(this)));
        if(thisLength > length){
          length = thisLength;
        }
        console.log('rounded polygon' + thisLength);
      });
      thisLines.find('line').each(function(){
        thisLength = Math.ceil(getLineLength($(this)));
        if(thisLength > length){
          length = thisLength;
        }
      });
      thisLines.find('circle').each(function(){
        thisLength = Math.ceil(getCircleLength($(this)));
        if(thisLength > length){
          length = thisLength;
        }
      });

      // assign value to attribue (not currently beign used, could be useful)
      thisSVG.attr("stroke-length", length);

      // set initial values, which will be animated out
      thisSVG.css({
        'stroke-dasharray': length,
        'stroke-dashoffset': length
      });

    });
  }


});
