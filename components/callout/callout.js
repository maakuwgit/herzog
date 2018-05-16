/**
* callout JS
* -----------------------------------------------------------------------------
*
* All the JS for the callout component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'callout',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this;
    },


    finalize: function() {

    }
  };

  // Hooks the component into the app
  app.registerComponent( 'callout', COMPONENT );
} )( app );
