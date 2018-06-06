/**
* Anchor Navigation JS
* -----------------------------------------------------------------------------
*
* All the JS for the anchor_nav component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'anchor_nav',

    selector : function() {
      return '.' + this.className;
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      var nav = $('[data-component="'+COMPONENT.className+'"]');//The WHOLE nav item
      nav.find('a[href^="#"]').on('click.setActive', this.setActive);
    },

    selectActive : function(slug) {
      console.log('selectActive', slug);
      if( slug ) {
        var nav = $('[data-component="'+COMPONENT.className+'"]');//The WHOLE nav item
        var a   = nav.find('a[href="#'+slug+'"]');
        if( a ) {
          a.trigger('click');
        }
      }else{
        return false;
      }
    },

    setActive : function(slug) {
      console.log('setActive', slug);
      if( slug ) {
        var nav = $('[data-component="'+COMPONENT.className+'"]');//The WHOLE nav item
        var a   = nav.find('a[href="#'+slug+'"]');
        if( a ) {
          nav.find('a').removeClass('active');
          a.addClass('active');
        }
      }else{
        $(this).closest('ol').find('a').removeClass('active');
        $(this).addClass('active');
      }
    },

    finalize: function() {

    }
  };

  // Hooks the component into the app
  app.registerComponent( 'anchor_nav', COMPONENT );
} )( app );
