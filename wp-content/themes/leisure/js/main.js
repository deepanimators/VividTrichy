(function ($) {
    "use strict";

	/** Define Mobile Enviroment */
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


  /** Maps */
	$(function() {
    $(document).ready(function(){

      if( $("#map-container").length > 0 ){
        $("#map-container").each(function(){
          var $map = $(this);
          var $lat = $map.data('lat');
  				var $lon = $map.data('lng');
  				var $type 	= $map.data('type');
  				var $theme 	= $map.data('theme');
  				var $zoom 	= $map.data('zoom');
          if( $theme === 'light' ){
					$theme = [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}];
				}

				if( $theme === 'dark' ){
					$theme = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];
				}

				if (typeof google === 'object' && typeof google.maps === 'object' ) {
					var map = new google.maps.Map( $map[0], {
						zoom: parseInt( $zoom ),
						center: { lat: Number( $lat ), lng: Number( $lon ) },
						mapTypeId: google.maps.MapTypeId[$type.toUpperCase()],
						mapTypeControl: false,
						mapTypeControlOptions: {},
						disableDefaultUI: true,
						draggable: true,
						navigationControl: true,
						scrollwheel: false,
						streetViewControl: false,
						styles: $theme
					});
					var marker = new google.maps.Marker({
	          position: { lat: Number( $lat ), lng: Number( $lon ) },
	          map: map
	        });
					$map.width("100%").height("100%");
				}
        });
      }
/*
			$("#map-container").width("100%").height("100%").gmap3({
				map:{
					options:{
							center: ['.$latitude.','.$longitude.'],
							zoom: '.$zoom.',
							disableDefaultUI: true,
							draggable: false,
							mapTypeId: google.maps.MapTypeId.'.strtoupper($map_type).',
							mapTypeControl: false,
							mapTypeControlOptions: {},
							navigationControl: false,
							scrollwheel: false,
							streetViewControl: false,
							styles: '.$style.'
					}
				},
				marker:{
					latLng: ['.$latitude.','.$longitude.']
				}
			});
      */
		});
  });


	/** Datepickers */
	$(function() {
    if ( $('.form-control[data-provide="date-picker"]').length > 0 ) {
      $('.form-control[data-provide="date-picker"]').each(function(){
        $(this).datepicker({
          beforeShow : function(textbox, instance){
            var $width = $(this).outerWidth();
                $width = $width < 250 ? 250 : $width;
            $('#ui-datepicker-div').css('min-width', $width );
          },
          showOtherMonths: true,
          selectOtherMonths: true,
          dateFormat: $(this).data('jquery-format'),
          monthNames: $(this).parents('.booking-form').data('locale-months').split(','),
          monthNamesShort: $(this).parents('.booking-form').data('locale-months-short').split(','),
          dayNames: $(this).parents('.booking-form').data('locale-days').split(','),
          dayNamesShort: $(this).parents('.booking-form').data('locale-days-short').split(','),
          dayNamesMin: $(this).parents('.booking-form').data('locale-days-min').split(','),
          firstDay: $(this).parents('.booking-form').data('locale-first-day')
        });
      });
    }
  });

  $('.modal-button').click(function() {
    $( $(this).data('target') ).modal();
  });


  $('body').on( 'change', '.prefill-text', function(){

    var $target = $(this).data('target');
    $($target).val( $(this).val() ).trigger('change');

  });

  $('body').on( 'change', '.prefill-datepicker', function(e){

    var $format = $(this).data('date-format');
    var $target = $(this).data('target');

    $($target).unwrap();
    const flatpickr = window.flatpickr($target, {}).setDate(moment( $(this).datepicker( "getDate" ) ).format('YYYY-MM-DD'), true)

  });

	$('body:not(.ie) .vc_tta-tab > a, body:not(.ie) .vc_tta-panel-title > a').on('click', function() {

		$(window).trigger('resize');

		if ( document.createEvent ) {
	        window.dispatchEvent( new Event('resize') );
	    } else {
	        document.body.fireEvent('onresize');
	    }

	});

	/** Lightbox */
  	if ( $('a[rel^="lightbox"]').length > 0 ) {

  		$(function () {
  		    $('a[rel^="lightbox"]').lightbox({
	  		    fixed: true
  		    });
		});
  	}

	/** Row Overlay */
	$( '.vc_row[class*="overlay-"]' ).each(function(){
		$(this).prepend('<div class="overlay"></div>');
	});



  	/** Main Navigation Dropdown */
  	$('#header .menu > ul, #header .menu-container > ul, #header #secondary-nav .menu').dropdown_menu();

	/** Secondary Navigation Submenu Background */
	$('#secondary-nav .sub-menu').each(function () {
		if ( $(this).parent().attr("data-background") ) {
			$(this).css('background-image', 'url('+$(this).parent().data("background")+')');
		}
	});

	/** Secondary Navigation */
	var menu_items = $('.menu:first-of-type > .menu-item', '#secondary-nav').length;
	$('.menu:first-of-type > .menu-item', '#secondary-nav').each(function () {
		$(this).css( 'width', 100 / menu_items + '%' );
	});


  	/** Mobile Menu */
  	if( isMobile.any() ){
  		$( '.menu li:has(ul)' ).doubleTapToGo();
  	}

  	/** Main Navigation Sticky */
  	if ( !isMobile.any() && data.sticky_menu ) {
  		$('#main-nav').waypoint('sticky', {
  			handler : function (direction) {
  				if ( direction === "down" ) {
  					var offset = $('#site').offset();
  					$('#main-nav').css('left', offset.left );
  					$('#header').addClass('z-index-5 sticky-header');
  				} else {
  					$('#main-nav').css('left', 0 );
  					$('#header').removeClass('z-index-5 sticky-header');
  				}

  			},
  			offset : - $('#header').outerHeight(),
  			stuckClass: 'stuck',
  		});
  	}

  	/** Gallery Carousel */
  	if ( $('.gallery-carousel').length > 0 ) {
	  	$('.gallery-carousel').each(function(){
			var container = $(this);
			imagesLoaded( container, function(){
		  		var galleryCarousel = container.owlCarousel({
		  			items				: container.data('owl-items'),
			    	margin				: 20,
			    	nav					: container.data('owl-nav'),
			    	navText				: container.data('owl-nav-text'),
			    	loop 				: container.data('owl-loop'),
			    	autoplay 			: container.data('owl-autoplay'),
			    	autoplayTimeout		: container.data('owl-speed'),
			    	responsiveBaseElement : $(container).parent('.gallery-carousel-container'),
			    	autoplayHoverPause	: true,
			    	lazyLoad			: true,
			    	responsive			: {
			    		0 : {
			    			items 	: 1,
			    			dots	: container.data('owl-dots'),
			    			nav		: container.data('owl-nav')
			    		},
			    		992 : {
			    			items 	: container.data('owl-items'),
			    			dots	: container.data('owl-dots')
			    		}
			    	}
		  		});
		  	});
		});

  	}



  	/** Content Carousel */
  	if ( $('.content-carousel').length > 0 ) {
  		$(".content-carousel").owlCarousel({
  			items				: 1,
  			nav					: false,
  			loop 				: false,
  			dots				: false,
  			URLhashListener		: true,
  			autoplay 			: false,
  			autoplayTimeout		: 2000,
  			autoplayHoverPause	: true
  		});
  	}

  	/** Stellar */
  	$( document ).ready(function() {
	    if( ! isMobile.any() && $('.parallax-container, .parallax, .parallax-image, div[data-stellar-background-ratio]').length > 0 ){
	  		$.stellar({
	  			horizontalScrolling: false,
	  			parallaxBackgrounds: false,
	  			hideDistantElements: false
	  		});
	  	}
	});

  	/** Nice Self Scroll */
  	$('a.nice-scroll[target="_self"]').on('click', function (e) {
  		e.preventDefault();
  		var target = $(this).attr('href');
  		$(target).velocity("scroll", { duration: 1000, easing: "easeOutCubic", offset: -( $('#main-nav').outerHeight() + 30 ) });
  	});



  	/** Search Form */
  	$('.search-button').on('click', function (e) {
  		e.preventDefault();

		$('#search-form').velocity("fadeIn");

		setTimeout(function(){

			$('#search-form .search-field').focus();

	  		$('#main-nav').mouseleave(function () {
		  		if( $('#search-form').is(":visible") ){
			  		$('#search-form').velocity("fadeOut");
		  		}

	  		});

		}, 300 );

  	});

  	$('.close-search').on('release', function (e) {
  		e.preventDefault();

  		$('#search-form').velocity("fadeOut");
  	});

  	/** Tooltips */
  	$("[data-toggle='tooltip']").tooltip();

  	/** Animations */
  	if ( $('.animated').length > 0 && ! isMobile.any() && data.animations === '' ) {
  		$('.animated').waypoint(function() {
  			var target = $(this);
  			if ( ! target.hasClass( 'animated_off' ) ) {
  				$(target).delay(150).velocity("transition.fadeIn");
  				target.addClass( 'animated_off' );
  			}
  		},{
  			offset: $.waypoints('viewportHeight')
  		});
  	} else {
  		$('.animated').css('opacity', 1);
  	}
  	if ( ! isMobile.any() && data.animations === '' ) {
	  	$( document ).ready(function() {
	  		$('#footer').waypoint(function() {
	  			if ( ! $('#footer').hasClass( 'animated_off' ) ) {
	  				$('aside', '#footer').delay(75).velocity("transition.fadeIn", { drag: true, stagger: 75 });
	  				$('#footer').addClass( 'animated_off' );
	  			}
	  		},{
	  			offset: $.waypoints('viewportHeight')
	  		});
  		});
  	} else {
  		$('aside', '#footer').css( 'opacity', 1 );
  	}

  	/** Mobile Navigation */
  	if ( isMobile.any() ) {
  		$('#toggle-secondary-nav').change(function () {
  			if ( $(this).is(':checked') ){
  				$('#toggle-main-nav').prop('checked', false);
  			}
  		});
  		$('#toggle-main-nav').change(function () {
  			if ( $(this).is(':checked') ){
  				$('#toggle-secondary-nav').prop('checked', false);
  			}
  		});
  	}

  	/** Gallery Isotope */
  	$(function() {
  	    if ( $('.gallery').length > 0 ) {

	  	    $('.gallery').each(function(){
		  	    var $container = $(this);
				$container.imagesLoaded(function(){
				  $container.isotope({
				        itemSelector : '.gallery-item',
				        layoutMode:  typeof $container.data('masonry-layout') !== 'undefined' ? $container.data('masonry-layout') : 'fitRows'
				  });
				});
	  	    });

  	    	$('img[class*=attachment-]', '.gallery').tooltip({
  	    		title : function () {
  	    			return $(this).attr('alt');
  	    		}
  	    	});
  	    }
  	});


  	/** Amenities Isotope */
  	$(function() {
  	    if ( $('.amenities').length > 0 ) {

	  	    $('.amenities').each(function(){
		  	    var $container = $( '.row', this );
				$container.imagesLoaded(function(){
				  $container.isotope({
				        itemSelector : '.col-lg-2',
				        layoutMode:  'fitRows'
				  });
				});
	  	    });
  	    }
  	});

  	/** Video Background */
  	$( document ).ready(function() {

	  	if( $('.vc_row[data-video-bg]').length > 0 ){

		  	$('.vc_row[data-video-bg]').each(function(){

		  	    var video_bg = $(this);

		  	    if( video_bg.data( 'video-bg' ) === 'html5' ){
				  	video_bg.background({
				    	source: {
				    		poster 	: video_bg.data('video-cover'),
				    		mp4		: video_bg.data('video-mp4'),
				    		ogg		: video_bg.data('video-ogg'),
				    		webm	: video_bg.data('video-webm')
				    	}
				    });
			  	} else {
				  	video_bg.background({
				    	source: {
				    		poster 	: video_bg.data('video-cover'),
				    		video	: video_bg.data('video-video')
				    	}
				    });
			  	}

	  	    });
	    }

	});

})(jQuery);
