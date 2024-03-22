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

	$( document ).ready(function() {

	  	/** Gallery Carousel */
	  	if ( $('#product-gallery').length > 0 ) {
		  	var $gallery = $("#product-gallery");
        var $gallery_items = $('.woocommerce-product-gallery__image', $gallery);
        if( $gallery_items.length > 1 ){
          imagesLoaded( $gallery, function(){
    				$gallery.owlCarousel({
    		  			items				: 4,
    		  			nav					: false,
    		  			stagePadding		: 0,
    		  			margin				: 10,
    		  			dots				: $gallery_items.length > 4 ? true : false,
    		  			autoHeight			: false,
    		  			loop 				: true,
                center: true
    		  		});
  	    	});
        }


	  	}

	  	/** Sale Animation */
	  	if ( $('.onsale').length > 0 ) {
	  		$('.onsale').velocity({
	  		    scale: 0.75
	  		  },
	  		  {
	  		    duration: 1000,
	  		    loop: true
	  		  });
	  	}

  		/** WooCommerce Grid */
	    if ( $('.woocommerce ul.products').length > 0 ) {
		    var container = $('.woocommerce ul.products');
  			imagesLoaded( container, function(){
  				container.isotope({
  	    		layoutMode: 'fitRows',
  	    		itemSelector: '.product'
  	    	});
			});
	    }

	    /** Cart Tooltip */
	    if ( $('.product_list_widget').length > 0 ) {
	    	$('.product_list_widget li').each(function(){
	    		if ( $('img', this).length > 0 ) {
	    			$(this).tooltip({
	    				html: true,
	    				title: function () {
	    					return '<img src="' + $('img', this).attr('src') + '">';
	    				},
	    				template: '<div class="tooltip tooltip-image" role="tooltip"><div class="tooltip-inner"></div></div>',
	    				placement : 'right auto'
	    			});
	    		}
	    	});
	    }

	    /** Widget Ratins */
	    if ( $('.widget_recent_reviews, .widget_top_rated_products').length > 0 ) {
	    	 $('.widget_recent_reviews .star-rating, .widget_top_rated_products .star-rating').each(function(){
	    	 	$(this).addClass('stars-' + parseInt($('.rating', this).html()) );
	    	 });
	    }

	    /** Sticky */
	    if ( ! isMobile.any() ) {
	    	if ( $('.equal-height').length > 0 ) {
	    		$('.equal-height').matchHeight();
	    		$("#payment-details").stick_in_parent({
	    			offset_top: $('#main-nav').outerHeight() + 10
	    		});

	    		$('#ship-to-different-address-checkbox + label, #createaccount + label').on('click', function () {
	    			setTimeout(function () {
	    				$('#customer_details .col-sm-6:last-of-type').css('min-height', $('#customer_details .col-sm-6:first-of-type').outerHeight() );
	    				$("#payment-details").trigger("sticky_kit:recalc");
	    			}, 500);
	    		});
	    	}
	    }

  	});

})(jQuery);
