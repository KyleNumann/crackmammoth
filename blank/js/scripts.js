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


  /* Lightbox */
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
