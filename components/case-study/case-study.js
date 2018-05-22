/**
* case-study JS
* -----------------------------------------------------------------------------
*
* All the JS for the case-study component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'case-study',


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
  app.registerComponent( 'case-study', COMPONENT );
} )( app );
