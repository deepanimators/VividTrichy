<div id="simple-weather--<?php echo $id ?>" class="simple-weather simple-weather--vue" :style="atts.inline_css">
  <template v-if="style !== 'widget'">
    <span v-if="hasCurrentWeather()" class="simple-weather__day simple-weather__day--current">
      <span v-if="filter_var(atts.show_units)" class="simple-weather__date">{{current_weather.dt | momentjs( atts.date )}}</span>
      <i class="sw" :class="getWeatherIcon(current_weather)"></i>
      <em class="simple-weather__temp">{{current_weather.temp | temp}} &deg;<template v-if="filter_var(atts.show_units)">{{units}}</template>
      </em>
    </span>
    <template v-if="weather_feed">
      <span v-for="(day, index) in weather_feed" v-if="isDayVisible(index, day)" class="simple-weather__day">
        <span v-if="filter_var(atts.show_units)" class="simple-weather__date">{{day.dt | momentjs(atts.date)}}</span>
        <i class="sw" :class="getWeatherIcon(day)"></i>
        <em class="simple-weather__temp">{{day.temp | temp}} &deg;<em class="simple-weather__temp-min" v-if="filter_var(atts.night)">{{day.temp_min | temp}} &deg;</em><template v-if="filter_var(atts.show_units)">{{units}}</template></em>
      </span>
    </template>
    <template v-else>
      <span v-html="error" class="error"></span>
    </template>
  </template>
  <template v-else>
    <div class="simple-weather-widget" v-if="current_weather.name || weather_feed" :class="atts.inline_css ? 'simple-weather-widget--bg' : ''">
      <h4 class='widget_title' v-if="atts.title || current_weather.name" v-text="atts.title ? atts.title : current_weather.name"></h4>
      <div class="temp">
        <span v-if="current_weather.temp" class="degrees">{{current_weather.temp | temp}} &deg;</span>
        <span class="details">
          <template v-if="current_weather.humidity"><?php _e('Humidity:' , 'SIMPLEWEATHER' ) ?> <em class="float-right">{{current_weather.humidity}}%</em><br></template>
          <template v-if="current_weather.clouds"><?php _e('Clouds:' , 'SIMPLEWEATHER' ) ?> <em class="float-right">{{current_weather.clouds}}%</em><br></template>
          <template v-if="current_weather.wind"><?php _e('Wind' , 'SIMPLEWEATHER'); ?> <small>({{current_weather.wind.deg}})</small>:
          <em class="float-right">{{current_weather.wind.speed}}<small>{{units_wind}}</small></em></template>
        </span>
      </div>
      <div class="summary">{{current_weather.desc}}</div>
      <div class="simple-weather-table" v-if="weather_feed">
        <div v-for="(day, index) in weather_feed" v-if="index < atts.days" class="simple-weather-table__row">
					<div class="simple-weather-table__date">{{day.dt | momentjs(atts.date)}}</div>
					<div class="simple-weather-table__icon"><i class="sw" :class="getWeatherIcon(day)"></i></div>
					<div class="simple-weather-table__temp">
            {{day.temp | temp}}&deg;
            <span class="simple-weather-table__temp-min">{{day.temp_min | temp}} &deg;</span>
          </div>
        </div>
      </div>
    </div>
  </template>
</div>
