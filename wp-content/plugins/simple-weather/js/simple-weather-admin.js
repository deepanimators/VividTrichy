if (typeof(document.getElementById("app")) != 'undefined' && document.getElementById("app") != null){

  var SimpleWeatherSettings = new Vue({
    el: '#app',
    data: function() {
      return {
        visible: false,
        form: {},
        loading: true,
        tabs: 'general'
      }
    },
    mounted: function(){
      var vm = this;
      vm.$http.get(
        window.SimpleWeather.rest_route + 'simple-weather/v1/options/',
        {
          //emulateHTTP: true
          headers: {
            'X-WP-Nonce': window.SimpleWeather.nonce
          }
        }
      ).then(vm.successCallback, vm.errorCallback);
    },
    methods: {
      onSubmit: function(){
        var vm = this;
        vm.loading = true;
        vm.$http.post(
          window.SimpleWeather.rest_route + 'simple-weather/v1/options/',
          vm.form,
          {
            emulateJSON: true,
            headers: {
              'X-WP-Nonce': window.SimpleWeather.nonce
            }
          }
        ).then(vm.successCallbackUpdate, vm.errorCallbackUpdate);
      },
      successCallback: function(response){
        var vm = this;
        vm.loading = false;
        vm.form = response.body;
      },
      errorCallback: function(response){
        var vm = this;
        vm.loading = false;
      },
      successCallbackUpdate: function(response){
        var vm = this;
        vm.loading = false;
        this.$notify({
          title: 'Success',
          message: 'Settings saved succesfully.',
          type: 'success',
          offset: 40,
          duration: 2000
        });
      },
      errorCallbackUpdate: function(response){
        var vm = this;
        vm.loading = false;
        this.$notify({
          title: 'Error',
          message: 'Settings could not be saved. Please try again!',
          type: 'error',
          offset: 40,
          duration: 2000
        });
      }
    }
  });
}
