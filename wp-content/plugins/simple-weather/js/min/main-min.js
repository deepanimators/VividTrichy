!function($){function d(d){d.find(".wp-color-picker").wpColorPicker()}function e(e,n){d(n)}function n(){$(".has-dependency[data-depends-on]").each(function(){var d=$(this).data("depends-value");d=d.split(",");var e=$(this).data("depends-on");if(e.indexOf("__i__")===-1){var n={};n[e]={values:d},$(this).dependsOn(n,{duration:0})}})}$(document).on("widget-added widget-updated",e),$(document).on("widget-added widget-updated",n),$(document).on("ready",n),$(document).ready(function(){$(".wp-color-picker").wpColorPicker()}),$(document).ajaxSuccess(function(){})}(jQuery);