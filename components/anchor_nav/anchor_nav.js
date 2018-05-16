/**
* Anchor Navigation JS
* -----------------------------------------------------------------------------
*
* All the JS for the anchor_nav component.
*/
( function( app ) {

  var COMPONENT = {

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      function setActive(e) {
        $(this).closest('ol').find('a').removeClass('active');
        $(this).addClass('active');
      }
      $('[data-component]').find('a[href^="#"]').on('click.setActive', setActive);
    },

    finalize: function() {

    }
  };

  // Hooks the component into the app
  app.registerComponent( 'anchor_nav', COMPONENT );
} )( app );
