(function($){

  function initColorPicker( widget ) {
    widget.find( '.wp-color-picker' ).wpColorPicker();
  }

  function onFormUpdate( event, widget ) {
    initColorPicker( widget );
  }

  function callDependencies(){

    $('.has-dependency[data-depends-on]').each(function(){

      var $values = $(this).data('depends-value');
          $values = $values.split(',');
      var $dep   = $(this).data('depends-on');

      if( $dep.indexOf('__i__') === -1 ){

        var myObject = {};
            myObject[$dep] = {
              values: $values
            };

        $(this).dependsOn( myObject, {
          duration: 0
        });
      }



    });

  }

  $(document).on( 'widget-added widget-updated', onFormUpdate );
  $(document).on( 'widget-added widget-updated', callDependencies );
  $(document).on( 'ready', callDependencies );

  $(document).ready( function() {

    $('.wp-color-picker').wpColorPicker();

  });

  $(document).ajaxSuccess(function() {

  });

}(jQuery));
