/**
* innovation-card JS
* -----------------------------------------------------------------------------
*
* All the JS for the innovation-card component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'innovation-card',


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
  app.registerComponent( 'innovation-card', COMPONENT );
} )( app );
