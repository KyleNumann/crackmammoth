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

	// global vars to be used later
	var scrollTop = $(window).scrollTop();
	var screenHeight = $(window).height();
	var screenWidth = $(window).width();

	$(window).scroll(function(){
		scrollTop = $(window).scrollTop();
	});
	$(window).resize(function() {
		screenWidth = $(window).width();
		screenHeight = $(window).height();

		// run any resize-dependant functions
		headerFeaturedImage();
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

	function headerFeaturedImage() {
		if($('.header-featured-image').length){
			var hero = $('.header-featured-image');
			hero.css('height', screenHeight);
		}
	}
	headerFeaturedImage();

  // init scrollr
  var s = skrollr.init({
    smoothScrolling: false
  });

  // Lightbox
  $('.image-lightbox').magnificPopup({
  type: 'image'
  // other options
  });

  // ------------- Smooth Scrolling
  $(function() {
  $('a.smooth-scroll').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
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



$(".wysiwyg").fitVids();


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






/*jshint browser:true */

/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

;(function( $ ){

  'use strict';

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement("div");
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        'iframe[src*="player.vimeo.com"]',
        'iframe[src*="youtube.com"]',
        'iframe[src*="youtube-nocookie.com"]',
        'iframe[src*="kickstarter.com"][src*="video.html"]',
        'object',
        'embed'
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not('object object'); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('name')){
          var videoName = 'fitvid' + $.fn.fitVids._count;
          $this.attr('name', videoName);
          $.fn.fitVids._count++;
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+'%');
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };

  // Internal counter for unique video names.
  $.fn.fitVids._count = 0;

// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

