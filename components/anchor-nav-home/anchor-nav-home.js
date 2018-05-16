/**
* anchor_nav-home JS
* -----------------------------------------------------------------------------
*
* All the JS for the anchor_nav-home component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-anchor-nav-home',


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
  app.registerComponent( 'anchor-nav-home', COMPONENT );
} )( app );
