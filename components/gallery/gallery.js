/**
* gallery JS
* -----------------------------------------------------------------------------
*
* All the JS for the gallery component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'gallery',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      var _this = this;
      var gallery = $("[data-component='"+_this.className+"']"),
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

        setProgress = function(e, slick, direction){
           var max   = slick['slideCount'],
               val   = slick['currentSlide'] + 1,
               nav   = $(this).attr('data-gallery-nav'),
               prog  = $('#'+nav).find('progress'),
               deets = $('#'+nav).find('[data-slick-details]'),
               curr  = val,
               total = max;

          if( max === 1 ){
            $(nav).detach();
          }else{
            if( val < 10 ){
              curr = '0' + val;
            }

            if( max < 10 ){
              total = '0' + max;
            }

            $(prog).attr({'max': max, 'value': val});
            $(deets).html(curr+' / '+total);
          }
        }

        gallery.each(function(){
          var sliderNav = $(this).attr('data-gallery-nav');
          if( sliderNav ) {
            sliderNav = $('#'+sliderNav);
            if( sliderNav ) {
              sliderNav = $(sliderNav).find('div');
            }
          }

          $(this).on('init', setProgress).slick({
            infinite: true,
            centerMode: false,
            fade: true,
            slidesToShow: 1,
            prevArrow: prevArrow,
            nextArrow: nextArrow,
            appendArrows: sliderNav
          }).on('afterChange', setProgress);
        });

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'gallery', COMPONENT );
} )( app );
