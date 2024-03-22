void 0!==SimpleWeather.locale&&(moment.defineLocale("en-SimpleWeather",SimpleWeather.locale),moment.locale("en-SimpleWeather")),Vue.filter("momentjs",(function(e,t,r){var i=SimpleWeather.locale.gmtOffset,n=0===i.toString().indexOf("-")?"-":"+";hours=parseInt(i/3600),hours=hours<10?"0"+hours:hours,minutes=i%3600,minutes=minutes<10?"0"+minutes:minutes;var d=n+hours+":"+minutes;return moment.defineLocale("en-SimpleWeather",SimpleWeather.locale),moment.locale("en-SimpleWeather"),!1!==r?moment(1e3*e).utcOffset(d).format(t):moment(1e3*e).format(t)}));var simple_weather_apps=[];Array.prototype.forEach.call(document.querySelectorAll("div.simple-weather--vue"),(function(e,t){var r=e.getAttribute("id").replace("simple-weather--","");simple_weather_apps[t]=new Vue({el:"#simple-weather--"+r,mounted:function(){var e=this,t=["simple-weather--vue-mounted"];void 0!==e.atts.text_align&&null!==e.atts.text_align&&e.atts.text_align.length>0&&t.push("simple-weather--text-"+e.atts.text_align),void 0!==e.atts.style&&null!==e.atts.style&&e.atts.style.length>0&&t.push("simple-weather--view-"+e.atts.style),void 0!==e.atts.display&&"block"===e.atts.display&&t.push("simple-weather--display-block"),void 0===e.show_date||e.filter_var(e.atts.show_date)||t.push("simple-weather--hidden-date"),e.$el.className+=" "+t.join(" "),void 0!==e.feed&&0===Object.keys(e.feed).length&&e.feed.constructor===Object&&e.get_weather()},data:function(){var e=this,t="&nbsp;",i=void 0!==window.SimpleWeatherAtts&&void 0!==window.SimpleWeatherAtts[r]?window.SimpleWeatherAtts[r]:{},n={},d={};return void 0!==i.station&&void 0!==window.SimpleWeatherFeeds&&void 0!==window.SimpleWeatherFeeds[r]&&(n=window.SimpleWeatherFeeds[r].forecast,d=void 0!==window.SimpleWeatherFeeds[r].current?window.SimpleWeatherFeeds[r].current:{}),{atts:i,feed:n,feed_current_weather:d,visible:[],error:t}},filters:{temp:function(e){return void 0!==e?parseInt(e):""}},computed:{units:function(){return void 0!==this.atts.units&&"imperial"===this.atts.units?"F":"C"},units_wind:function(){return void 0!==this.atts.units&&"imperial"===this.atts.units?"mph":"kph"},onecall:function(){return void 0!==this.atts.latitude&&null!==this.atts.latitude&&this.atts.latitude.length>0&&void 0!==this.atts.longitude&&null!==this.atts.longitude&&this.atts.longitude.length>0},current_weather:function(){var e=this,t={},r=e.onecall?e.feed.current:e.feed_current_weather;return e.onecall?(void 0!==e.feed.current&&void 0!==e.feed.current.weather[0].id&&(t.id=e.feed.current.weather[0].id,t.desc=e.feed.current.weather[0].description),void 0!==e.feed.current&&void 0!==e.feed.current.dt&&(t.dt=e.feed.current.dt),void 0!==e.feed.current&&void 0!==e.feed.current.temp&&(t.temp=e.feed.current.temp,t.humidity=Math.ceil(e.feed.current.humidity)),void 0!==e.feed.current&&void 0!==e.feed.current.clouds&&(t.clouds=Math.ceil(e.feed.current.clouds)),void 0!==e.feed.current&&void 0!==e.feed.current.wind_deg&&void 0!==e.feed.current.wind_speed&&(t.wind={},t.wind.deg=e.getWindDirection(e.feed.current.wind_deg),t.wind.speed="metric"===e.units?3.6*e.feed.current.wind_speed:3.6*e.feed.current.wind_speed/1.609344,t.wind.speed=Math.ceil(t.wind.speed)),t.name=void 0!==e.feed.current&&void 0!==e.feed.current.name?e.feed.current.name:""):(void 0!==e.feed_current_weather.weather&&void 0!==e.feed_current_weather.weather[0].id&&(t.id=e.feed_current_weather.weather[0].id,t.desc=e.feed_current_weather.weather[0].description),void 0!==e.feed_current_weather.dt&&(t.dt=e.feed_current_weather.dt),void 0!==e.feed_current_weather.main&&void 0!==e.feed_current_weather.main.temp&&(t.temp=e.feed_current_weather.main.temp,t.humidity=Math.ceil(e.feed_current_weather.main.humidity)),void 0!==e.feed_current_weather.clouds&&(t.clouds=Math.ceil(e.feed_current_weather.clouds.all)),void 0!==e.feed_current_weather.wind&&(t.wind={},t.wind.deg=e.getWindDirection(e.feed_current_weather.wind.deg),t.wind.speed="metric"===e.units?3.6*e.feed_current_weather.wind.speed:3.6*e.feed_current_weather.wind.speed/1.609344,t.wind.speed=Math.ceil(t.wind.speed)),void 0!==e.feed_current_weather.name&&(t.name=e.feed_current_weather.name)),t},weather_feed:function(){var e=this,t=[],r=moment().utcOffset(this.get_utc_offset()),i={},n=[];return(n=e.onecall?void 0!==e.feed&&void 0!==e.feed.daily?e.feed.daily:[]:void 0!==e.feed&&void 0!==e.feed.list?e.feed.list:[]).length>0&&(n.forEach((function(t,r){t.dt_txt=e.onecall?moment.unix(t.dt).utcOffset(e.get_utc_offset()).format("DD-MM-YYYY"):t.dt_txt;var n=t.dt_txt.split(" ");n=n[0];var d=e.onecall?t.temp:t.main.temp;void 0!==i[n]?i[n].push(d):i[n]=[d]})),n.forEach((function(n,d){var a=n.dt_txt.split(" ");if(a=a[0],!r.isSame(1e3*n.dt,"day"))if(e.onecall)t.push({dt:n.dt,id:n.weather[0].id,temp:n.temp.max,temp_min:n.temp.min});else{var s=void 0!==i[a]?i[a].reduce((function(e,t){return Math.max(e,t)})):null,o=void 0!==i[a]?i[a].reduce((function(e,t){return Math.min(e,t)})):null;t.push({dt:n.dt,id:n.weather[0].id,temp:s,temp_min:o})}r=moment(1e3*n.dt).utcOffset(e.get_utc_offset())}))),t.length>0&&t},weather_station:function(){return"openweather"},style:function(){var e=this;return void 0===e.atts.style?"inline":e.atts.style}},methods:{in_darkSky_feed:function(){var e=this},get_utc_offset:function(){var e=this,t=SimpleWeather.locale.gmtOffset,r=0===t.toString().indexOf("-")?"-":"+",i;return hours=parseInt(t/3600),hours=hours<10?"0"+hours:hours,minutes=t%3600,minutes=minutes<10?"0"+minutes:minutes,r+hours+":"+minutes},getWindDirection:function(e){return e>=0&&e<22.5?"N":e>=22.5&&e<45?"NNE":e>=45&&e<67.5?"NE":e>=67.5&&e<90?"ENE":e>=90&&e<122.5?"E":e>=112.5&&e<135?"ESE":e>=135&&e<157.5?"SE":e>=157.5&&e<180?"SSE":e>=180&&e<202.5?"S":e>=202.5&&e<225?"SSW":e>=225&&e<247.5?"SW":e>=247.5&&e<270?"WSW":e>=270&&e<292.5?"W":e>=292.5&&e<315?"WNW":e>=315&&e<337.5?"NW":e>=337.5&&e<360?"NNW":void 0},getWeatherIcon:function(e){return"darksky"===this.weather_station?"sw-forecast-io-"+e.id:"sw-owm-"+e.id},isset:function(e){return void 0!==vm.atts[e]&&null!==vm.atts[e]&&vm.atts[e].length>0},hasCurrentWeather:function(){var e=this;return e.filter_var(e.atts.show_current)&&Object.keys(e.current_weather).length>0},isDayVisible:function(e,t){var r=this,i=!1,n=parseInt(r.atts.days);return(!r.filter_var(r.atts.show_current)||!moment(1e3*r.current_weather.dt).utcOffset(this.get_utc_offset()).isSame(1e3*t.dt,"day"))&&e<n},filter_var:function(e){return[1,!0,"on","true","1","yes"].indexOf(e)>=0},get_weather:function(){var e=this;e.$http.post(window.SimpleWeather.rest_route+"simple-weather/v1/get_weather/",e.atts,{emulateJSON:!0}).then(e.successCallback,e.errorCallback)},successCallback:function(e){var t=this;t.filter_var(window.SimpleWeather.settings.console_log)&&console.log(e),"openweather"===t.weather_station&&e.status>=200&&e.status<=202&&(void 0!==e.body.current&&(t.feed_current_weather=e.body.current),void 0!==e.body.forecast&&(t.feed=e.body.forecast)),"darksky"===t.weather_station&&e.status>=200&&e.status<=202&&(void 0!==e.body.forecast&&void 0!==e.body.forecast.currently&&(t.feed_current_weather=e.body.forecast.currently),e.body.forecast,void 0!==e.body.forecast.daily&&(t.feed=e.body.forecast.daily))},errorCallback:function(e){var t=this;t.filter_var(window.SimpleWeather.settings.console_log)&&console.log(e),void 0!==e.body.code&&["could_not_get_location","no_api"].indexOf(e.body.code)>=0&&(t.error=e.body.message)}}})}));