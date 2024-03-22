!function($){var t="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==",o='<a tabindex="0" class="wp-color-result" />',i='<div class="wp-picker-holder" />',r='<div class="wp-picker-container" />',e='<input type="button" class="button button-small hidden" />';Color.fn.toString=function(){if(this._alpha<1)return this.toCSS("rgba",this._alpha).replace(/\s+/g,"");var t=parseInt(this._color,10).toString(16);return this.error?"":(t.length<6&&(t=("00000"+t).substr(-6)),"#"+t)},$.widget("wp.wpColorPicker",$.wp.wpColorPicker,{_create:function(){if($.support.iris){var a=this,n=a.element;$.extend(a.options,n.data()),a.close=$.proxy(a.close,a),a.initialValue=n.val(),n.addClass("wp-color-picker").hide().wrap(r),a.wrap=n.parent(),a.toggler=$(o).insertBefore(n).css({backgroundColor:a.initialValue}).attr("title",wpColorPickerL10n.pick).attr("data-current",wpColorPickerL10n.current),a.pickerContainer=$(i).insertAfter(n),a.button=$(e),a.options.defaultColor?a.button.addClass("wp-picker-default").val(wpColorPickerL10n.defaultString):a.button.addClass("wp-picker-clear").val(wpColorPickerL10n.clear),n.wrap('<span class="wp-picker-input-wrap" />').after(a.button),n.iris({target:a.pickerContainer,hide:a.options.hide,width:a.options.width,mode:a.options.mode,palettes:a.options.palettes,change:function(o,i){a.options.alpha?(a.toggler.css({"background-image":"url("+t+")"}).html("<span />"),a.toggler.find("span").css({width:"100%",height:"100%",position:"absolute",top:0,left:0,"border-top-left-radius":"3px","border-bottom-left-radius":"3px",background:i.color.toString()})):a.toggler.css({backgroundColor:i.color.toString()}),$.isFunction(a.options.change)&&a.options.change.call(this,o,i)}}),n.val(a.initialValue),a._addListeners(),a.options.hide||a.toggler.click()}},_addListeners:function(){var t=this;t.wrap.on("click.wpcolorpicker",function(t){t.stopPropagation()}),t.toggler.on("click",function(){t.toggler.hasClass("wp-picker-open")?t.close():t.open()}),t.element.on("change",function(o){(""===$(this).val()||t.element.hasClass("iris-error"))&&(t.options.alpha?(t.toggler.removeAttr("style"),t.toggler.find("span").css("backgroundColor","")):t.toggler.css("backgroundColor",""),$.isFunction(t.options.clear)&&t.options.clear.call(this,o))}),t.toggler.on("keyup",function(o){13!==o.keyCode&&32!==o.keyCode||(o.preventDefault(),t.toggler.trigger("click").next().focus())}),t.button.on("click",function(o){$(this).hasClass("wp-picker-clear")?(t.element.val(""),t.options.alpha?(t.toggler.removeAttr("style"),t.toggler.find("span").css("backgroundColor","")):t.toggler.css("backgroundColor",""),$.isFunction(t.options.clear)&&t.options.clear.call(this,o)):$(this).hasClass("wp-picker-default")&&t.element.val(t.options.defaultColor).change()})}}),$.widget("a8c.iris",$.a8c.iris,{_create:function(){if(this._super(),this.options.alpha=!0,this.element.is(":input")||(this.options.alpha=!1),"undefined"!=typeof this.options.alpha&&this.options.alpha){var t=this,o=t.element,i='<div class="iris-strip iris-slider iris-alpha-slider"><div class="iris-slider-offset iris-slider-offset-alpha"></div></div>',r=$(i).appendTo(t.picker.find(".iris-picker-inner")),e=r.find(".iris-slider-offset-alpha"),a={aContainer:r,aSlider:e};"undefined"!=typeof o.data("custom-width")?t.options.customWidth=parseInt(o.data("custom-width"))||0:t.options.customWidth=100,t.options.defaultWidth=o.width(),(t._color._alpha<1||t._color.toString().indexOf("rgb")!==-1)&&o.width(parseInt(t.options.defaultWidth+t.options.customWidth)),$.each(a,function(o,i){t.controls[o]=i}),t.controls.square.css({"margin-right":"0"});var n=t.picker.width()-t.controls.square.width()-20,s=n/6,l=n/2-s;$.each(["aContainer","strip"],function(o,i){t.controls[i].width(l).css({"margin-left":s+"px"})}),t._initControls(),t._change()}},_initControls:function(){if(this._super(),this.options.alpha){var t=this,o=t.controls;o.aSlider.slider({orientation:"vertical",min:0,max:100,step:1,value:parseInt(100*t._color._alpha),slide:function(o,i){t._color._alpha=parseFloat(i.value/100),t._change.apply(t,arguments)}})}},_change:function(){this._super();var o=this,i=o.element;if(this.options.alpha){var r=o.controls,e=parseInt(100*o._color._alpha),a=o._color.toRgb(),n=["rgb("+a.r+","+a.g+","+a.b+") 0%","rgba("+a.r+","+a.g+","+a.b+", 0) 100%"],s=o.options.defaultWidth,l=o.options.customWidth,c=o.picker.closest(".wp-picker-container").find(".wp-color-result");r.aContainer.css({background:"linear-gradient(to bottom, "+n.join(", ")+"), url("+t+")"}),c.hasClass("wp-picker-open")&&(r.aSlider.slider("value",e),o._color._alpha<1?(r.strip.attr("style",r.strip.attr("style").replace(/rgba\(([0-9]+,)(\s+)?([0-9]+,)(\s+)?([0-9]+)(,(\s+)?[0-9\.]+)\)/g,"rgb($1$3$5)")),i.width(parseInt(s+l))):i.width(s))}var p=i.data("reset-alpha")||!1;p&&o.picker.find(".iris-palette-container").on("click.palette",".iris-palette",function(){o._color._alpha=1,o.active="external",o._change()})},_addInputListeners:function(t){var o=this,i=100,r=function(i){var r=new Color(t.val()),e=t.val();t.removeClass("iris-error"),r.error?""!==e&&t.addClass("iris-error"):r.toString()!==o._color.toString()&&("keyup"===i.type&&e.match(/^[0-9a-fA-F]{3}$/)||o._setOption("color",r.toString()))};t.on("change",r).on("keyup",o._debounce(r,i)),o.options.hide&&t.on("focus",function(){o.show()})}})}(jQuery),jQuery(document).ready(function($){$(".wp-color-picker").wpColorPicker()});