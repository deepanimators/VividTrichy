/**!
 * wp-color-picker-alpha
 *
 * Overwrite Automattic Iris for enabled Alpha Channel in wpColorPicker
 * Only run in input and is defined data alpha in true
 *
 * Version: 3.0.0
 * https://github.com/kallookoo/wp-color-picker-alpha
 * Licensed under the GPLv2 license or later.
 */
!function(o,a){var t,r={version:300};if("wpColorPickerAlpha"in window&&"version"in window.wpColorPickerAlpha){var i=parseInt(window.wpColorPickerAlpha.version,10);if(!isNaN(i)&&r.version<=i)return}Color.fn.hasOwnProperty("to_s")||(Color.fn.to_s=function(o){"hex"===(o=o||"hex")&&this._alpha<1&&(o="rgba");var a="";return"hex"===o?a=this.toString():this.error||(a=this.toCSS(o).replace(/\(\s+/,"(").replace(/\s+\)/,")")),a},window.wpColorPickerAlpha=r,t="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==",o.widget("a8c.iris",o.a8c.iris,{alphaOptions:{alphaEnabled:!1},_getColor:function(o){return o===a&&(o=this._color),this.alphaOptions.alphaEnabled?(o=o.to_s(this.alphaOptions.alphaColorType),this.alphaOptions.alphaColorWithSpace||(o=o.replace(/\s+/g,"")),o):o.toString()},_create:function(){try{this.alphaOptions=this.element.wpColorPicker("instance").alphaOptions}catch(o){}o.extend({},this.alphaOptions,{alphaEnabled:!1,alphaCustomWidth:130,alphaReset:!1,alphaColorType:"hex",alphaColorWithSpace:!1}),this._super()},_addInputListeners:function(o){function a(a){var r=o.val(),i=new Color(r),l=(r=r.replace(/^(#|(rgb|hsl)a?)/,""),t.alphaOptions.alphaColorType);o.removeClass("iris-error"),i.error?""!==r&&o.addClass("iris-error"):"hex"===l&&"keyup"===a.type&&r.match(/^[0-9a-fA-F]{3}$/)||i.toIEOctoHex()!==t._color.toIEOctoHex()&&t._setOption("color",t._getColor(i))}var t=this;o.on("change",a).on("keyup",t._debounce(a,100)),t.options.hide&&o.one("focus",(function(){t.show()}))},_initControls:function(){var a,t,r,i;this._super(),this.alphaOptions.alphaEnabled&&(r=(t=(a=this).controls.strip.clone(!1,!1)).find(".iris-slider-offset"),i={stripAlpha:t,stripAlphaSlider:r},t.addClass("iris-strip-alpha"),r.addClass("iris-slider-offset-alpha"),t.appendTo(a.picker.find(".iris-picker-inner")),o.each(i,(function(o,t){a.controls[o]=t})),a.controls.stripAlphaSlider.slider({orientation:"vertical",min:0,max:100,step:1,value:parseInt(100*a._color._alpha),slide:function(o,t){a.active="strip",a._color._alpha=parseFloat(t.value/100),a._change.apply(a,arguments)}}))},_dimensions:function(o){if(this._super(o),this.alphaOptions.alphaEnabled){for(var a=this,t=a.options,r=a.controls.square,i=(o=a.picker.find(".iris-strip"),Math.round(a.picker.outerWidth(!0)-(t.border?22:0))),l=Math.round(r.outerWidth()),e=Math.round((i-l)/2),s=Math.round(e/2),n=Math.round(l+2*e+2*s);i<n;)e=Math.round(e-2),s=Math.round(s-1),n=Math.round(l+2*e+2*s);r.css("margin","0"),o.width(e).css("margin-left",s+"px")}},_change:function(){var a,r,i,l=this,e=l.active;l._super(),l.alphaOptions.alphaEnabled&&(a=l.controls,r=parseInt(100*l._color._alpha),i=["rgb("+(i=l._color.toRgb()).r+","+i.g+","+i.b+") 0%","rgba("+i.r+","+i.g+","+i.b+", 0) 100%"],l.picker.closest(".wp-picker-container").find(".wp-color-result"),l.options.color=l._getColor(),a.stripAlpha.css({background:"linear-gradient(to bottom, "+i.join(", ")+"), url("+t+")"}),e&&a.stripAlphaSlider.slider("value",r),l._color.error||l.element.removeClass("iris-error").val(l.options.color),l.picker.find(".iris-palette-container").on("click.palette",".iris-palette",(function(){var a=o(this).data("color");l.alphaOptions.alphaReset&&(l._color._alpha=1,a=l._getColor()),l._setOption("color",a)})))},_paintDimension:function(o,a){var t=this,r=!1;t.alphaOptions.alphaEnabled&&"strip"===a&&(r=t._color,t._color=new Color(r.toString()),t.hue=t._color.h()),t._super(o,a),r&&(t._color=r)},_setOption:function(o,a){var t=this;if("color"!==o||!t.alphaOptions.alphaEnabled)return t._super(o,a);a=""+a,newColor=new Color(a).setHSpace(t.options.mode),newColor.error||t._getColor(newColor)===t._getColor()||(t._color=newColor,t.options.color=t._getColor(),t.active="external",t._change())},color:function(o){return!0===o?this._color.clone():o===a?this._getColor():void this.option("color",o)}}),o.widget("wp.wpColorPicker",o.wp.wpColorPicker,{alphaOptions:{alphaEnabled:!1},_getAlphaOptions:function(){var a=this.element,t=a.data("type")||this.options.type,r=a.data("defaultColor")||a.val(),i={alphaEnabled:a.data("alphaEnabled")||!1,alphaCustomWidth:130,alphaReset:!1,alphaColorType:"rgb",alphaColorWithSpace:!1};return i.alphaEnabled&&(i.alphaEnabled=a.is("input")&&"full"===t),i.alphaEnabled&&(i.alphaColorWithSpace=r&&r.match(/\s/),o.each(i,(function(o,t){var l=a.data(o)||t;switch(o){case"alphaCustomWidth":l=l?parseInt(l,10):0,l=isNaN(l)?t:l;break;case"alphaColorType":l.match(/^(hex|(rgb|hsl)a?)$/)||(l=r&&r.match(/^#/)?"hex":r&&r.match(/^hsla?/)?"hsl":t);break;default:l=!!l}i[o]=l}))),i},_create:function(){o.support.iris&&(this.alphaOptions=this._getAlphaOptions(),this._super())},_addListeners:function(){if(!this.alphaOptions.alphaEnabled)return this._super();var a=this,r=a.element,i=a.toggler.is("a");this.alphaOptions.defaultWidth=r.width(),this.alphaOptions.alphaCustomWidth&&r.width(parseInt(this.alphaOptions.defaultWidth+this.alphaOptions.alphaCustomWidth,10)),a.toggler.css({position:"relative","background-image":"url("+t+")"}),i?a.toggler.html('<span class="color-alpha" />'):a.toggler.append('<span class="color-alpha" />'),a.colorAlpha=a.toggler.find("span.color-alpha").css({width:"30px",height:"100%",position:"absolute",top:0,"background-color":r.val()}),"ltr"===a.colorAlpha.css("direction")?a.colorAlpha.css({"border-bottom-left-radius":"2px","border-top-left-radius":"2px",left:0}):a.colorAlpha.css({"border-bottom-right-radius":"2px","border-top-right-radius":"2px",right:0}),r.iris({change:function(t,r){a.colorAlpha.css({"background-color":r.color.to_s(a.alphaOptions.alphaColorType)}),o.isFunction(a.options.change)&&a.options.change.call(this,t,r)}}),a.wrap.on("click.wpcolorpicker",(function(o){o.stopPropagation()})),a.toggler.click((function(){a.toggler.hasClass("wp-picker-open")?a.close():a.open()})),r.change((function(t){var l=o(this).val();(r.hasClass("iris-error")||""===l||l.match(/^(#|(rgb|hsl)a?)$/))&&(i&&a.toggler.removeAttr("style"),a.colorAlpha.css("background-color",""),o.isFunction(a.options.clear)&&a.options.clear.call(this,t))})),a.button.click((function(t){o(this).hasClass("wp-picker-default")?r.val(a.options.defaultColor).change():o(this).hasClass("wp-picker-clear")&&(r.val(""),i&&a.toggler.removeAttr("style"),a.colorAlpha.css("background-color",""),o.isFunction(a.options.clear)&&a.options.clear.call(this,t),r.trigger("change"))}))}}))}(jQuery);