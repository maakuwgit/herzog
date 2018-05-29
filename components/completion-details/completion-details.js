/**
* completion-details JS
* -----------------------------------------------------------------------------
*
* All the JS for the completion-details component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'completion-details',


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
  app.registerComponent( 'completion-details', COMPONENT );
} )( app );
