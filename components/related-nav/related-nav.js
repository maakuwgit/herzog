/**
* related-nav JS
* -----------------------------------------------------------------------------
*
* All the JS for the related-nav component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'related-nav',


    selector : function() {
      return '.' + this.className;
    },

    openNav: function(e) {
      $(this).off('click.openNav').on('click.closeNav', COMPONENT.closeNav);
      $(this).addClass("active").next().addClass("active");
    },

    closeNav: function(e) {
      $(this).off('click.closeNav').on('click.openNav', COMPONENT.openNav);
      $(this).removeClass("active").next().removeClass("active");
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      var _this = this,
          target = $('[data-trigger="related-nav"]');
      target.on('click.openNav', this.openNav);
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'related-nav', COMPONENT );
} )( app );
