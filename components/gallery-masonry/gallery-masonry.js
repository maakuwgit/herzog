/**
* gallery-masonry JS
* -----------------------------------------------------------------------------
*
* All the JS for the gallery-masonry component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'gallery-masonry',


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
  app.registerComponent( 'gallery-masonry', COMPONENT );
} )( app );
