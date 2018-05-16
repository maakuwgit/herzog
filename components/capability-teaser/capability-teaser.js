/**
* capability-teaser JS
* -----------------------------------------------------------------------------
*
* All the JS for the capability-teaser component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'capability-teaser',


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
  app.registerComponent( 'capability-teaser', COMPONENT );
} )( app );
