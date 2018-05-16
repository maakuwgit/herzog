/**
* leader-grid JS
* -----------------------------------------------------------------------------
*
* All the JS for the leader-grid component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'leader-grid',


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
  app.registerComponent( 'leader-grid', COMPONENT );
} )( app );
