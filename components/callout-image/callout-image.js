/**
* callout-image JS
* -----------------------------------------------------------------------------
*
* All the JS for the callout-image component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'callout-image',


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
  app.registerComponent( 'callout-image', COMPONENT );
} )( app );
