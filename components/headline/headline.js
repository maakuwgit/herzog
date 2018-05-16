/**
* Headline JS
* -----------------------------------------------------------------------------
*
* All the JS for the Headline component.
*/
( function( app ) {

  var COMPONENT = {

    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
    },

    finalize: function() {

    }
  };

  // Hooks the component into the app
  app.registerComponent( 'headline', COMPONENT );
} )( app );
