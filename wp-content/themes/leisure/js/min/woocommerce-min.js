!function($){"use strict";var t={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)},any:function(){return t.Android()||t.BlackBerry()||t.iOS()||t.Opera()||t.Windows()}};$(document).ready(function(){if($("#product-gallery").length>0){var e=$("#product-gallery"),i=$(".woocommerce-product-gallery__image",e);i.length>1&&imagesLoaded(e,function(){e.owlCarousel({items:4,nav:!1,stagePadding:0,margin:10,dots:i.length>4,autoHeight:!1,loop:!0,center:!0})})}if($(".onsale").length>0&&$(".onsale").velocity({scale:.75},{duration:1e3,loop:!0}),$(".woocommerce ul.products").length>0){var o=$(".woocommerce ul.products");imagesLoaded(o,function(){o.isotope({layoutMode:"fitRows",itemSelector:".product"})})}$(".product_list_widget").length>0&&$(".product_list_widget li").each(function(){$("img",this).length>0&&$(this).tooltip({html:!0,title:function(){return'<img src="'+$("img",this).attr("src")+'">'},template:'<div class="tooltip tooltip-image" role="tooltip"><div class="tooltip-inner"></div></div>',placement:"right auto"})}),$(".widget_recent_reviews, .widget_top_rated_products").length>0&&$(".widget_recent_reviews .star-rating, .widget_top_rated_products .star-rating").each(function(){$(this).addClass("stars-"+parseInt($(".rating",this).html()))}),t.any()||$(".equal-height").length>0&&($(".equal-height").matchHeight(),$("#payment-details").stick_in_parent({offset_top:$("#main-nav").outerHeight()+10}),$("#ship-to-different-address-checkbox + label, #createaccount + label").on("click",function(){setTimeout(function(){$("#customer_details .col-sm-6:last-of-type").css("min-height",$("#customer_details .col-sm-6:first-of-type").outerHeight()),$("#payment-details").trigger("sticky_kit:recalc")},500)}))})}(jQuery);