/**
* leader-grid JS
* -----------------------------------------------------------------------------
*
* All the JS for the leader-grid component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'leader-grid',


    selector : function() {
      return '.' + this.className;
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      var _this = this;
      var gallery = $("body:not(.post-type-archive-team) [data-component='"+_this.className+"']");
      gallery.find('> .container.row').each(function(){
        $(this).slick({
          infinite: false,
          fade: false,
          slidesToShow: 4,
          slidesToScroll: 4,
          arrows: false,
          responsive: [
            {
              breakpoint: 1281,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3
              }
            },
            {
              breakpoint: 769,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: "unslick"
            }
          ]
        });
      });
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'leader-grid', COMPONENT );
} )( app );
