/**
* inforgraphic JS
* -----------------------------------------------------------------------------
*
* All the JS for the inforgraphic component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'll-inforgraphic',


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
  app.registerComponent( 'inforgraphic', COMPONENT );
} )( app );
