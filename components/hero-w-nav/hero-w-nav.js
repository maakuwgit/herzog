/**
* hero-w-nav JS
* -----------------------------------------------------------------------------
*
* All the JS for the hero-w-nav component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'hero-w-nav',


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
  app.registerComponent( 'hero-w-nav', COMPONENT );
} )( app );
