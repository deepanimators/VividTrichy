(function ($) {
    "use strict";

    $("document").ready(function(){
      $('[data-vc-full-width="true"]').width($('[data-vc-full-width="true"]').width()-1);
      $('[data-vc-full-width="true"]').width($('[data-vc-full-width="true"]').width()+1);
      $('[data-vc-full-width="true"]').trigger('resize');

      setTimeout(function(){
        $('[data-vc-full-width="true"]').width($('[data-vc-full-width="true"]').width()-1);
        $('[data-vc-full-width="true"]').width($('[data-vc-full-width="true"]').width()+1);
        $('[data-vc-full-width="true"]').trigger('resize');
      }, 1);
    });

    /** Nice Self Scroll */
    $('a.smooth-scroll, .smooth-scroll > a').on('click', function (e) {
  		e.preventDefault();
  		var target = $(this).attr('href');
  		var offset = $('.ct-header__wrapper--stuck').outerHeight() || 0
            offset = parseInt(offset)
      $('html, body').animate({
          scrollTop: $(target).offset().top - offset
      }, 700);
  	});
    $('.wpb_single_image.smooth-scroll a').on('click', function (e) {
  		e.preventDefault();
  		var target = $(this).attr('href');
      $('html, body').animate({
          scrollTop: $(target).offset().top - $('.ct-header__wrapper--stuck').outerHeight()
      }, 700);
  	});

    $('.wpb_single_image[data-img-hover]').each(function(){

      var img = $('img', this).attr('src');
      var img_hover = $(this).data('img-hover');

      $('img', this).hover(function(){
        $(this).attr( 'src', img_hover );
        $(this).attr( 'srcset', $(this).attr('srcset').replace( img, img_hover ) );
      }, function(){
        $(this).attr( 'src', img );
        $(this).attr( 'srcset', $(this).attr('srcset').replace( img_hover, img ) );
      });
    });

    var isMobile = {
	    Android: function() {
	        return navigator.userAgent.match(/Android/i);
	    },
	    BlackBerry: function() {
	        return navigator.userAgent.match(/BlackBerry/i);
	    },
	    iOS: function() {
	        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	    },
	    Opera: function() {
	        return navigator.userAgent.match(/Opera Mini/i);
	    },
	    Windows: function() {
	        return navigator.userAgent.match(/IEMobile/i);
	    },
	    any: function() {
	        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
	    }
	};

  $('body').on('section-reached', function(){

   var section         = $('body').sectionScroll.activeSection;
   var section_title   = $(section).attr('data-section-title');
   var section_color   = $(section).attr('data-section-color');
   var section_list    = $('.section-bullets');

   if(typeof section_color === 'undefined' ){
     $(section_list).attr('style', '');
   } else{
     $(section_list).css('color', section_color);
   }

   if(typeof section_title === 'undefined' ){

     if( $('.section-title', section_list ).length > 0 ){
       $('.section-title', section_list ).addClass('is_hidden');
     }

   } else {

     if( $('.section-title', section_list ).length === 0 ){

       $( section_list ).prepend( '<li class="section-title"><div><span>' + section_title  + '<span></div></li>');

     } else {
       $('.section-title').removeClass('is_hidden');
       $('.section-title > div > span', section_list ).text( section_title );

     }

   }

  });

  $(function() {

    if( ! isMobile.any() && $('.parallax-image[data-stellar-ratio]').length > 0 ){
  		$.stellar({
  			horizontalScrolling: false,
  			parallaxBackgrounds: false,
  			hideDistantElements: false
  		});
  	}

    if( $('.scrollable-section').length > 0 ){
      $('body').sectionScroll({
        titles: false
      });
    }


    $('.xtd-carousel-mini > .owl-carousel').each(function(){

        var container = $(this);

        imagesLoaded( container, function(){

          container.owlCarousel({
            items				  : 1,
            nav					  : false,
            navText				: ['',''],
            dots				  : container.data('dots'),
            loop 				  : container.data('loop'),
            dotsSpeed     : 700,
            autoplay 			: container.data('autoplay'),
            autoplayTimeout		: container.data('timeout'),
            autoplayHoverPause	: container.data('hover'),
            autoHeight    : true
          });

        });

    });

      $('.xtd-carousel-filmstrip').each(function(){

        var filmstrip = $(this);

        imagesLoaded( filmstrip, function(){
          filmstrip.bxSlider({
            slideSelector : '.wpb_single_image',
            ticker: true,
            minSlides: 4,
            speed: $(filmstrip).data('speed'),
            onSliderLoad: function(){
              $('body').trigger('bxSlider-ready')
            }
          });
        });

      });


    $('.xtd-gmap').each(function(){
      let map = $(this);
        $(this).height(map.data('height'))
        if (typeof window.google === 'object' && typeof window.google.maps === 'object' && map ) {
            const options = {
                center: { lat: Number( map.data('latitude-center')  ), lng: Number( map.data('longitude-center') )  },
                zoom: parseInt( map.data('zoom') ),
                mapTypeId: window.google.maps.MapTypeId[map.data('type').toUpperCase()],
                mapTypeControl: false,
                mapTypeControlOptions: {},
                navigationControl: false,
                scrollwheel: false,
                streetViewControl: false,
                disableDefaultUI: true,
                draggable: false,
                styles: map.data('theme').length >= 1 ? map.data('theme') : ''
            }
            let map_object = new window.google.maps.Map(map[0], options)
            let marker = new window.google.maps.Marker({
                position: { lat: Number( map.data('latitude-center')  ), lng: Number( map.data('longitude-center') )  },
                map: map_object
            });
            const $image = map.data('image-src');
            const $title = map.data('title');
            const $description = map.data('description');
            const has_image = typeof $image !== 'undefined' && $image.length > 0
            const has_title = typeof $title !== 'undefined' && $title.length > 0
            const has_description = typeof $description !== 'undefined' && $description.length > 0
            if( has_image || has_title || has_description ){
                let $html = '';
                $html = '<div class="content"><div class="xtd-gmap-info">';
                $html += has_image ? '<img src="' + $image + '">' : '';
                $html += has_title ? '<div>' + $title + '</div>' : '';
                $html += has_description ? '<p>' + $description + '</p>' : '';
                $html += '</div></div>';
                const infowindow = new google.maps.InfoWindow({
                    content: $html
                }).open(map_object, marker);
                marker.addListener("click", () => {
                    infowindow.open(map_object, marker);
                });
            }
        }
    });

  });


  $("document").ready(function(){
    if( jQuery().magnificPopup ) {
      $('.xtd-modal--inline > .vc_btn3[href^=#], a.xtd-modal--inline[href^=#]').magnificPopup({
          type: 'inline',
          closeBtnInside:true
      });
    }
  });



})(jQuery);
