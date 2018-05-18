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
      nav = $('[data-component="'+this.className+'"]');//The WHOLE nav item
      next = nav.find('.section-next');//Find the next btn
      prev = nav.find('.section-prev');//Find the prev btn
      dts = nav.find('dt')//Find ALL the definition titles
      dds = nav.find('dd');//Find ALL the definition descriptions

      function goNext(e) {
        if( prev.hasClass('muted') ) {
          prev.removeClass('muted').on('click.goPrev', goPrev);
        }
        //Store these first, our active section
        dta = nav.find('dt.active');
        dda = nav.find('dd.active');

        //Then let's store these to check against in our deactivation logic later
        dtn = dta.next().next();
        ddn = dda.next().next();

        //So we know what anchor nav and section this pertains to
        slug = dtn.attr('data-section-id');

        //This is unused at this time, but will be VERY useful for responsive
        nav.attr('data-section', slug);

        if( dtn.length ){
          dts.removeClass('active');
          dds.removeClass('active');
          dtn.addClass('active');
          ddn.addClass('active');

          //Check for a button in the Anchor Nav, if it's there, let's click it
          btn = $('[data-component="anchor_nav"]').find('a[href="#'+slug+'"]');
          if( btn ){
            btn.trigger('click');
          }

          dtn = dtn.next().next();

          //Now let's check for next so we can deactivate
          if( !dtn.length ) {
            next.addClass('muted').off('click.goNext');
          }
        }else{
          next.addClass('muted').off('click.goNext');
        }
      }

      function goPrev(e) {
        if( next.hasClass('muted')){
          next.removeClass('muted').on('click.goNext', goNext);
        }
        //Store these first, our active section
        dta = nav.find('dt.active');
        dda = nav.find('dd.active');

        //Then let's store these to check against in our deactivation logic later
        dtp = dta.prev().prev();
        ddp = dda.prev().prev();

        //So we know what anchor nav and section this pertains to
        slug = dtp.attr('data-section-id');

        if( dtp.length ){
          //Toggle active/inactive
          dts.removeClass('active');
          dds.removeClass('active');
          dtp.addClass('active');
          ddp.addClass('active');

          //Check for a button in the Anchor Nav, if it's there, let's click it
          btn = $('[data-component="anchor_nav"]').find('a[href="#'+slug+'"]');
          if( btn ){
            btn.trigger('click');
          }

          //Now let's check for prev so we can deactivate
          dtp = dtp.prev().prev();
          if( !dtp.length ){
            prev.addClass('muted').off('click.goPrev');
          }
        }else{
          prev.addClass('muted').off('click.goPrev');
        }
      }

      next.on('click.goNext', goNext);
      prev.addClass('muted');
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'section-nav', COMPONENT );
} )( app );
