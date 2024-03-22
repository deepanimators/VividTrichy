!function($){var t="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==",o='<div class="wp-picker-holder" />',r='<div class="wp-picker-container" />',e='<input type="button" class="button button-small" />',i=void 0!==wpColorPickerL10n.current;if(i)var a='<a tabindex="0" class="wp-color-result" />';else var a='<button type="button" class="button wp-color-result" aria-expanded="false"><span class="wp-color-result-text"></span></button>',n="<label></label>",l='<span class="screen-reader-text"></span>';Color.fn.toString=function(){if(this._alpha<1)return this.toCSS("rgba",this._alpha).replace(/\s+/g,"");var t=parseInt(this._color,10).toString(16);return this.error?"":(t.length<6&&(t=("00000"+t).substr(-6)),"#"+t)},$.widget("wp.wpColorPicker",$.wp.wpColorPicker,{_create:function(){if($.support.iris){var s=this,p=s.element;if($.extend(s.options,p.data()),"hue"===s.options.type)return s._createHueOnly();s.close=$.proxy(s.close,s),s.initialValue=p.val(),p.addClass("wp-color-picker"),i?(p.hide().wrap(r),s.wrap=p.parent(),s.toggler=$(a).insertBefore(p).css({backgroundColor:s.initialValue}).attr("title",wpColorPickerL10n.pick).attr("data-current",wpColorPickerL10n.current),s.pickerContainer=$(o).insertAfter(p),s.button=$(e).addClass("hidden")):(p.parent("label").length||(p.wrap(n),s.wrappingLabelText=$(l).insertBefore(p).text(wpColorPickerL10n.defaultLabel)),s.wrappingLabel=p.parent(),s.wrappingLabel.wrap(r),s.wrap=s.wrappingLabel.parent(),s.toggler=$(a).insertBefore(s.wrappingLabel).css({backgroundColor:s.initialValue}),s.toggler.find(".wp-color-result-text").text(wpColorPickerL10n.pick),s.pickerContainer=$(o).insertAfter(s.wrappingLabel),s.button=$(e)),s.options.defaultColor?(s.button.addClass("wp-picker-default").val(wpColorPickerL10n.defaultString),i||s.button.attr("aria-label",wpColorPickerL10n.defaultAriaLabel)):(s.button.addClass("wp-picker-clear").val(wpColorPickerL10n.clear),i||s.button.attr("aria-label",wpColorPickerL10n.clearAriaLabel)),i?p.wrap('<span class="wp-picker-input-wrap" />').after(s.button):(s.wrappingLabel.wrap('<span class="wp-picker-input-wrap hidden" />').after(s.button),s.inputWrapper=p.closest(".wp-picker-input-wrap")),p.iris({target:s.pickerContainer,hide:s.options.hide,width:s.options.width,mode:s.options.mode,palettes:s.options.palettes,change:function(o,r){s.options.alpha?(s.toggler.css({"background-image":"url("+t+")"}),i?s.toggler.html('<span class="color-alpha" />'):(s.toggler.css({position:"relative"}),0==s.toggler.find("span.color-alpha").length&&s.toggler.append('<span class="color-alpha" />')),s.toggler.find("span.color-alpha").css({width:"30px",height:"24px",position:"absolute",top:0,left:0,"border-top-left-radius":"2px","border-bottom-left-radius":"2px",background:r.color.toString()})):s.toggler.css({backgroundColor:r.color.toString()}),$.isFunction(s.options.change)&&s.options.change.call(this,o,r)}}),p.val(s.initialValue),s._addListeners(),s.options.hide||s.toggler.click()}},_addListeners:function(){var t=this;t.wrap.on("click.wpcolorpicker",function(t){t.stopPropagation()}),t.toggler.click(function(){t.toggler.hasClass("wp-picker-open")?t.close():t.open()}),t.element.on("change",function(o){(""===$(this).val()||t.element.hasClass("iris-error"))&&(t.options.alpha?(i&&t.toggler.removeAttr("style"),t.toggler.find("span.color-alpha").css("backgroundColor","")):t.toggler.css("backgroundColor",""),$.isFunction(t.options.clear)&&t.options.clear.call(this,o))}),t.button.on("click",function(o){$(this).hasClass("wp-picker-clear")?(t.element.val(""),t.options.alpha?(i&&t.toggler.removeAttr("style"),t.toggler.find("span.color-alpha").css("backgroundColor","")):t.toggler.css("backgroundColor",""),$.isFunction(t.options.clear)&&t.options.clear.call(this,o)):$(this).hasClass("wp-picker-default")&&t.element.val(t.options.defaultColor).change()})}}),$.widget("a8c.iris",$.a8c.iris,{_create:function(){if(this._super(),this.options.alpha=this.element.data("alpha")||!1,this.element.is(":input")||(this.options.alpha=!1),void 0!==this.options.alpha&&this.options.alpha){var t=this,o=t.element,r='<div class="iris-strip iris-slider iris-alpha-slider"><div class="iris-slider-offset iris-slider-offset-alpha"></div></div>',e=$(r).appendTo(t.picker.find(".iris-picker-inner")),i=e.find(".iris-slider-offset-alpha"),a={aContainer:e,aSlider:i};void 0!==o.data("custom-width")?t.options.customWidth=parseInt(o.data("custom-width"))||0:t.options.customWidth=100,t.options.defaultWidth=o.width(),(t._color._alpha<1||-1!=t._color.toString().indexOf("rgb"))&&o.width(parseInt(t.options.defaultWidth+t.options.customWidth)),$.each(a,function(o,r){t.controls[o]=r}),t.controls.square.css({"margin-right":"0"});var n=t.picker.width()-t.controls.square.width()-20,l=n/6,s=n/2-l;$.each(["aContainer","strip"],function(o,r){t.controls[r].width(s).css({"margin-left":l+"px"})}),t._initControls(),t._change()}},_initControls:function(){if(this._super(),this.options.alpha){var t=this;t.controls.aSlider.slider({orientation:"vertical",min:0,max:100,step:1,value:parseInt(100*t._color._alpha),slide:function(o,r){t._color._alpha=parseFloat(r.value/100),t._change.apply(t,arguments)}})}},_change:function(){this._super();var o=this,r=o.element;if(this.options.alpha){var e=o.controls,i=parseInt(100*o._color._alpha),a=o._color.toRgb(),n=["rgb("+a.r+","+a.g+","+a.b+") 0%","rgba("+a.r+","+a.g+","+a.b+", 0) 100%"],l=o.options.defaultWidth,s=o.options.customWidth,p=o.picker.closest(".wp-picker-container").find(".wp-color-result");e.aContainer.css({background:"linear-gradient(to bottom, "+n.join(", ")+"), url("+t+")"}),p.hasClass("wp-picker-open")&&(e.aSlider.slider("value",i),o._color._alpha<1?(e.strip.attr("style",e.strip.attr("style").replace(/rgba\(([0-9]+,)(\s+)?([0-9]+,)(\s+)?([0-9]+)(,(\s+)?[0-9\.]+)\)/g,"rgb($1$3$5)")),r.width(parseInt(l+s))):r.width(l))}(r.data("reset-alpha")||!1)&&o.picker.find(".iris-palette-container").on("click.palette",".iris-palette",function(){o._color._alpha=1,o.active="external",o._change()})},_addInputListeners:function(t){var o=this,r=100,e=function(r){var e=new Color(t.val()),i=t.val();t.removeClass("iris-error"),e.error?""!==i&&t.addClass("iris-error"):e.toString()!==o._color.toString()&&("keyup"===r.type&&i.match(/^[0-9a-fA-F]{3}$/)||o._setOption("color",e.toString()))};t.on("change",e).on("keyup",o._debounce(e,100)),o.options.hide&&t.on("focus",function(){o.show()})}})}(jQuery),jQuery(document).ready(function($){$(".wp-color-picker").wpColorPicker()});