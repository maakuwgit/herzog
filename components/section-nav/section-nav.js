/**
* section_nav JS
* -----------------------------------------------------------------------------
*
* All the JS for the section_nav component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'section-nav',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'section-nav', COMPONENT );
} )( app );
