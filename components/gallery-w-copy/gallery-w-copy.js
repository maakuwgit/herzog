/**
* gallery-w-copy JS
* -----------------------------------------------------------------------------
*
* All the JS for the gallery-w-copy component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'gallery-w-copy',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'gallery-w-copy', COMPONENT );
} )( app );
