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
      var gallery = $("body:not(.post-type-archive-team) [data-component='"+_this.className+"']"),
          nextArrow = '',
          prevArrow = '';

        prevArrow = '<button type="button" class="slick-prev">';
        prevArrow += '<svg>';
        prevArrow += '<use xlink:href="#icon-chevron-left"></use>';
        prevArrow += '</svg></button>';

        nextArrow += '<button type="button" class="slick-next">';
        nextArrow += '<svg>';
        nextArrow += '<use xlink:href="#icon-chevron-right"></use>';
        nextArrow += '</svg></button>';
/*
        gallery.find('> .container').slick({
            infinite: true,
            fade: true,
            slidesToShow: 4,
            slidesToScroll: 3,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            appendArrows: $(this),
            centerMode: true,
            variableWidth: true
        });*/

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'testimonial-grid', COMPONENT );
} )( app );
