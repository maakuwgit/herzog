/**
* callout JS
* -----------------------------------------------------------------------------
*
* All the JS for the accordion component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'accordion',
    speedIn: 100,
    speedOut: 50,

    selector : function() {
      return '.' + this.className;
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      var _this     = this,
          accordion = $('[data-component="accordion"]'),
          content   = $( accordion ).find('.accordion'),
          triggers  = $( accordion ).find('.accordion--trigger'),
          prev      = $( accordion ).find('[data-accordion-prev]'),
          next      = $( accordion ).find('[data-accordion-next]');

      var numAcc  = triggers.length,
          currAcc = 0;

      $(window).on('resize.refactorAccordions', refactorAccordions );
      refactorAccordions();

      function refactorAccordions(e) {
        if( $(window).outerWidth() > breakpoints.lg ) {
          triggers.on('mouseenter.hoverAccordion', hoverAccordion);
          prev.on('click.prevContent', prevContent);
          next.on('click.nextContent', nextContent);
        }else{
          triggers.off('mouseenter.hoverAccordion');
          prev.off('click.prevContent');
          next.off('click.nextContent');
        }
      }

      function resetAccordions(e) {
        triggers.removeClass('active').off('mouseenter.hoverAccordion').on('mouseenter.hoverAccordion', hoverAccordion);

        prev.off('click.prevContent').on('click.prevContent', prevContent);
        next.off('click.nextContent').on('click.nextContent', nextContent);
        showAccordion();
      }

      function prevContent(e) {
        var index = (currAcc - 1);
        if( triggers[index] ) $(triggers[index]).mouseenter();
      }

      function nextContent(e) {
        var index = (currAcc + 1);
        if( triggers[index] ) $(triggers[index]).mouseenter();
      }

      function hoverAccordion(e) {
        e.preventDefault();
        resetAccordions(e);
        var trigger = $(this),
            nav     = $(trigger).parent().parent(),
            pBtn    = $(nav).find('[data-accordion-prev]'),
            nBtn    = $(nav).find('[data-accordion-next]');

        $(trigger).off('mouseenter.hoverAccordion');
        currAcc = $(trigger).attr('data-content-num');

        if( currAcc == numAcc - 1 ) {
          $(nBtn).addClass('muted').off('click.nextContent');
          $(pBtn).removeClass('muted').on('click.prevContent', prevContent);
        }
        if( currAcc == 0 ) {
          $(nBtn).removeClass('muted').on('click.nextContent', nextContent);
          $(pBtn).addClass('muted').off('click.prevContent');
        }

        triggers.removeClass('active');
        showAccordion(trigger);
      }

      function showAccordion(target) {
        $(content).removeClass('active');
        if( target ) {
          target.addClass('active');
          $(target).next().addClass('active');
        }
      }
    },

    finalize: function() {

    }
  };

  // Hooks the component into the app
  app.registerComponent( 'accordion', COMPONENT );
} )( app );
