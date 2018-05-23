/**
* testimonial-grid JS
* -----------------------------------------------------------------------------
*
* All the JS for the testimonial-grid component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'testimonial-grid',


    selector : function() {
      return '.' + this.className;
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      var _this = this;
      var gallery = $("body:not(.post-type-archive-testimonial) [data-component='"+_this.className+"']");
      gallery.find('ul.row').each(function(){
        $(this).slick({
          infinite: false,
          fade: false,
          slidesToShow: 3,
          slidesToScroll: 3,
          arrows: false
        });
      });
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'testimonial-grid', COMPONENT );
} )( app );
