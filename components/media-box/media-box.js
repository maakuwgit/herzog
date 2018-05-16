/**
* photobox JS
* -----------------------------------------------------------------------------
*
* All the JS for the photobox component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'media-box',


    selector : function() {
      return '.' + this.className;
    },


    // Fires after common.init, before .finalize and common.finalize
    init: function() {

      function showHero(e) {
        var fig        = $(this).siblings('figure'),
            content    = $(this).attr('data-rel'),
            btn        = $(fig).find('a.button'),
            feat       = $(fig).find('.feature'),
            from_slide = $(feat).children().eq(0),
            to_slide   = $(feat).children().not(from_slide);

        var move_slide = $(from_slide).detach();
        content = $('div[data-rel="'+content+'"]');
        $('div[data-rel]').hide();
        $(feat).append(move_slide);
        $(btn).attr({'href': $(this).attr('data-btn-href'), 'title': $(this).attr('data-btn-title')});
        $(this).addClass('active').off('mouseenter.showHero').find('nav').show();
        $(this).siblings('article').removeClass('active').on('mouseenter.showHero', showHero).find('nav').hide();
        $(content).show();
        $(window).resize();
      }

      var _this = this;
      $('[data-component="media-box"]').each(function(){
        var fig  = $(this).find('figure[data-background]'),
            arts = $(this).find('article'),
            curr = $(fig).attr('data-active-slide');

        $(arts).not('.active').on('mouseenter.showHero', showHero);
      });

    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'media-box', COMPONENT );
} )( app );
