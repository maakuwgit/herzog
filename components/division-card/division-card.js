/**
* division-card JS
* -----------------------------------------------------------------------------
*
* All the JS for the division-card component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'division-card',


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
  app.registerComponent( 'division-card', COMPONENT );
} )( app );
