/**
* related-nav JS
* -----------------------------------------------------------------------------
*
* All the JS for the related-nav component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'related-nav',


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
  app.registerComponent( 'related-nav', COMPONENT );
} )( app );
