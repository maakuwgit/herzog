/**
* locations-filterable JS
* -----------------------------------------------------------------------------
*
* All the JS for the locations-filterable component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'locations-filterable',


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
  app.registerComponent( 'locations-filterable', COMPONENT );
} )( app );
