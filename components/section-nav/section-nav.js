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

    setActive : function(slug) {
      nav = $('[data-component="'+COMPONENT.className+'"]');//The WHOLE nav item
      dts = nav.find('dt')//Find ALL the definition titles
      dds = nav.find('dd');//Find ALL the definition descriptions

      dta = nav.find('dt[data-section-id="'+slug+'"]');
      dda  = dta.next();

      if( dta.length ) {
        //This is unused at this time, but will be VERY useful for responsive
        nav.attr('data-section', slug);

        //Toggle active/inactive
        dts.removeClass('active');
        dds.removeClass('active');

        dta.addClass('active');
        dda.addClass('active');
      }
    },

    goPrev : function(e) {
      nav = $('[data-component="'+COMPONENT.className+'"]');//The WHOLE nav item
      next = nav.find('.section-next');//Find the next btn
      prev = nav.find('.section-prev');//Find the prev btn
      dts = nav.find('dt')//Find ALL the definition titles
      dds = nav.find('dd');//Find ALL the definition descriptions
      if( next.hasClass('muted')){
        next.removeClass('muted').on('click.goNext', COMPONENT.goNext);
      }
      //Store these first, our active section
      dta = nav.find('dt.active');
      dda = nav.find('dd.active');

      //Then let's store these to check against in our deactivation logic later
      dtp = dta.prev().prev();
      ddp = dda.prev().prev();

      if( dtp.length ){
        //Toggle active/inactive
        dts.removeClass('active');
        dds.removeClass('active');
        dtp.addClass('active');
        ddp.addClass('active');

        COMPONENT.setActive(dtp.attr('data-section-id'));

        //Now let's check for prev so we can deactivate
        dtp = dtp.prev().prev();
        if( !dtp.length ){
          prev.addClass('muted').off('click.goPrev');
        }
      }else{
        prev.addClass('muted').off('click.goPrev');
      }
    },

    goNext : function(e) {
      nav = $('[data-component="'+COMPONENT.className+'"]');//The WHOLE nav item
      next = nav.find('.section-next');//Find the next btn
      prev = nav.find('.section-prev');//Find the prev btn
      dts = nav.find('dt')//Find ALL the definition titles
      dds = nav.find('dd');//Find ALL the definition descriptions

      if( prev.hasClass('muted') ) {
        prev.removeClass('muted').on('click.goPrev', COMPONENT.goPrev);
      }
      //Store these first, our active section
      dta = nav.find('dt.active');
      dda = nav.find('dd.active');

      //Then let's store these to check against in our deactivation logic later
      dtn = dta.next().next();
      ddn = dda.next().next();

      if( dtn.length ){
        dts.removeClass('active');
        dds.removeClass('active');
        dtn.addClass('active');
        ddn.addClass('active');

        COMPONENT.setActive(dtn.attr('data-section-id'));

        dtn = dtn.next().next();

        //Now let's check for next so we can deactivate
        if( !dtn.length ) {
          next.addClass('muted').off('click.goNext');
        }
      }else{
        next.addClass('muted').off('click.goNext');
      }
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      nav = $('[data-component="'+this.className+'"]');//The WHOLE nav item
      next = nav.find('.section-next');//Find the next btn
      prev = nav.find('.section-prev');//Find the prev btn
      dts = nav.find('dt')//Find ALL the definition titles
      dds = nav.find('dd');//Find ALL the definition descriptions

      next.on('click.goNext', this.goNext);
      prev.addClass('muted');
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'section-nav', COMPONENT );
} )( app );
