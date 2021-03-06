/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

( function( app ) {

  var COMPONENT = {


    init: function() {
      var vh,vw;
      //Media Query (match the _variables.scss breakpoints)
      breakpoints = {};
      breakpoints.xxs = 399;
      breakpoints.xs  = 479;
      breakpoints.sm  = 767;
      breakpoints.md  = 991;
      breakpoints.lg  = 1199;
      breakpoints.xl  = 1599;

      var adminHeight   = ( $('#wpadminbar').length > 0 ? $('#wpadminbar').outerHeight() : 0 ),
          section_nav   = '.section-nav',
          footer        = 'body > footer',
          prefooter     = 'body > .callout',
          hero          = '.hero, .hero-w-nav',
          primary_nav   = 'body > header',
          location_nav  = $('[data-location-nav]'),
          counters      = $('[data-component="callout-numbers"]'),
          toggler       = $('[data-toggle]'),
          sections      = $('body > article section, body > article picture');

      window.userLoggedIn = false;
      window.adminBarHeight = 0;

      var adminbar = $('#wpadminbar');

      if ( adminbar.length > 0 ) {
        window.userLoggedIn = true;
        window.adminBarHeight = '32px';
      }

      /**
       * IF your navbar is fixed
       * use this function
       */
      function checkAdminBar() {
         if ( window.userLoggedIn ) {
           $('body > header').css('top', window.adminBarHeight);
         }
      }

      function setSize(){
        vw = window.outerWidth;
        vh = window.outerHeight;
      }

      function getSize(){
        var size = 'small';
        if(vw >= breakpoints.xl){
          size = 'xl';
        }else if(vw >= breakpoints.lg && vw < breakpoints.xl) {
          size = 'lg';
        }else if(vw > breakpoints.sm && vw < breakpoints.lg) {
          size = 'md';
        }
        return size;
      }

      function refactor(e){
        setSize();
        var size = getSize();
        //Dev Note: Create a date attr for the size and only call 'makeBg' oncer per size.
        makeBg(size);
      }

      function closeInterstitial(e){
        $(this).animate({'opacity':0}, 300, function(){
          $(this).addClass('hide').removeAttr('style');
        });
      }

      function closeProject(e){
        $('[data-location]').removeClass('active');
        $('body').removeClass('globe-selection-made');
      }

      //checkAdminBar();

      $(function() {
        function hideClose(e) {
          TweenMax.to(location_nav, 0.3, {scale:0, rotation: 90, opacity:0});
        }

        function showClose(e) {
          TweenMax.to(location_nav, 0.3, {scale:1, rotation: 0, opacity:1});
        }

        function enterSection(e) {
          var target = $(e.target.triggerElement()),
              id     = target.attr('id');

          target.addClass('enter');
          if( id ) {
            app.components['section-nav'].setActive(id);
          }
        }

        function leaveSection(e) {
          var target = $(e.target.triggerElement()),
              id     = target.attr('id');

          target.removeClass('enter');
          if( id ) {
            app.components['section-nav'].setActive(id);
          }
        }

        function enterCounter(e) {
          var target = $(e.target.triggerElement());
          enterSection(e);
          app.components['callout-numbers'].startCounter(target.find('[data-count]'));
        }

        function leaveCounter(e) {
          var target = $(e.target.triggerElement());
          leaveSection(e);
          app.components['callout-numbers'].resetCounter(target.find('[data-count]'));
        }

        //If theres a controller for ScrollMagic, spool it up!
        if( typeof ScrollMagic !== 'undefined' ) {

          var controller  = new ScrollMagic.Controller(),
              offset      = 0;

          if ( $(hero) ) {
            offset = ( $(hero).height() + $(primary_nav).height() - adminHeight );

            //Adding styles to the anchor nav and pinning
            if( $(section_nav) ) {
              var section_navs_pin = new ScrollMagic.Scene({
                triggerElement: hero,
                offset: offset
              })
              .setClassToggle(section_nav,'left')
              .addTo(controller);

              if( $(prefooter) ) {
                var section_navs_release = new ScrollMagic.Scene({
                  triggerElement: prefooter,
                  offset: $(prefooter).height()
                })
                .on("enter", function () {
                  $(section_nav).removeClass('left');
                })
                .on("leave", function () {
                  $(section_nav).addClass('left');
                })
                .addTo(controller);
              }
            }

            //Animate the Prefooter elements
            if( $(prefooter) ) {
              var prefooter_anim = new ScrollMagic.Scene({
                triggerElement: prefooter,
                offset: -1 * $(prefooter).height()/2
              })
              .setClassToggle(prefooter,'enter')
              .addTo(controller);

              var location_nav_anim = new ScrollMagic.Scene({
                triggerElement: prefooter
              })
              .on("enter", hideClose)
              .on("leave", showClose)
              .addTo(controller);
            }

            //Adding styles to the primary nav and pinning
            if( $(primary_nav) ) {
              var primary_pin = new ScrollMagic.Scene({
                triggerElement: hero,
                offset: offset
              })
              .setClassToggle(primary_nav,'top')
              .addTo(controller);
            }
          }

          //Animate the Sections in a general fashion
          if ( $(sections) ) {
            for( s = 0; s < sections.length; s++ ) {
              section = sections[s];

              offset = -1.334 * $(section).height();

              var section_animate = new ScrollMagic.Scene({
                triggerElement: section,
                offset: offset
              })
              .on("enter", enterSection)
              .on("leave", leaveSection)
              .addTo(controller);
            }
          }

          //Animate the Counters inside Callouts
          if ( $(counters) ) {
            for( c = 0; c < counters.length; c++ ) {
              counter = counters[c];

              offset = -1.334 * $(counter).height();

              var count_start = new ScrollMagic.Scene({
                triggerElement: counter,
                offset: offset
              })
              .on("enter", enterCounter)
              .on("leave", leaveCounter)
              .addTo(controller);
            }
          }
        }

        //Animate everything with this one class
        $('body').addClass('loaded');
        var setAnimated = setTimeout(function(){
          $('body').addClass('animated');
          //Dev Note:
        }, 2000);

        //Dropdown menu function
        toggler.click(function(){
          if( !$(primary_nav).hasClass('expanded') ) {
            $(primary_nav).addClass('expanded');
          }else if( $(this).next().hasClass('collapsed') ){
            $(primary_nav).removeClass('expanded');
          }
        });

        //Timeline
        var panels = $('[data-hover-panels] .panel');

        function updatePanels(e) {
          $(panels).each(function(){
            if( !$(this).hasClass('open') ){
              $(this).addClass('dim');
            }
          });
          $(this).removeClass('dim');
        }

        function openPanel(e) {
          var wrapper = $(this).parent();
          $(panels).removeClass('open').addClass('transparent');
          $(this).addClass('open').removeClass('transparent');
          wrapper.css('background-image', 'url('+$(this).find('.feature img').attr('src')+')');
        }

        function closePanel(e) {
          $(panels).off('mouseenter.updatePanels').off('click.openPanel');
          $(panels).removeClass('open').removeClass('transparent').removeClass('dim');
          setTimeout(function(){
            $(panels).on('mouseenter.updatePanels', updatePanels).on('click.openPanel', openPanel);
          }, 300);
        }

        $('[data-hover-panels]').each( function(i) {
          $(panels).addClass('dim');
          $(this).find('.panel').on('click.openPanel', openPanel).on('mouseenter.updatePanels', updatePanels);
          $(this).find('.button-close').on('click.closePanel', closePanel);
        } );
        //EOF

        //Project/Projects
        $('[data-interstitial]').on('click.closeInterstitial', closeInterstitial);
        $('[data-location-nav]').on('click.closeProject', closeProject);

        $('a[href*="#"]:not(.js-no-scroll):not([href="#"])').click(function() {
          if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
            var target = $(this.hash);
            var wpadminBarHeight = 0;
            if ( adminbar.length > 0 ) {
              wpadminBarHeight = adminbar.outerHeight();
            }
            var headerHeight = $('body > header').outerHeight();
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html, body').animate({
                scrollTop: target.offset().top - ( headerHeight + wpadminBarHeight )
              }, 1000);
              return false;
            }
          }
        });

        $(window).on('resize.refactor', refactor);
        refactor();
      });

      // JavaScript to be fired on all pages
      function clickthrough(e) {
        var target = $(this).find('a:first-of-type');
        e.preventDefault();
        if(target && target.length > 0){
          document.location.href = target.attr('href');
        }else{
          document.location.href = $(this).attr('data-clickthrough');
        }
      }

      // Converts a thumbnail into a link by reading the first link and using that
      $('[data-clickthrough]').each(function(args){
        $(this).on('click.clickthrough', clickthrough);
      });

      //Reads the "featured" image (class based) and sets the target background to whatever image is dynamically loaded then animates it in.
      function makeBg(size){
        if(!size){
          size = getSize();
        }
        $('[data-background]').each(function(args){
          var feat    = $(this).find('.feature');
          var target  = feat;//See if there's a featured image here, if not, just use the parent
          if(feat.length <= 0) {
            target = $(this);
          }

          var img     = false;

          if(feat.length > 0) {
            img = $(feat).find('img');
          }else{
            img = $(this).find('img');
          }

          if(img.length > 0) {
            var src = $(img).attr('src');
            if($(img).attr('data-src-xl') && size === 'xl') {
              src = $(img).attr('data-src-xl');
            }
            if($(img).attr('data-src-lg') && size === 'lg') {
              src = $(img).attr('data-src-lg');
            }
            if($(img).attr('data-src-md') && size === 'md') {
              src = $(img).attr('data-src-md');
            }
            if($(this).attr('style')){
                if(feat.length > 0) {
                  $(feat).css('background-color',$(this).css('background-color'));
                  $(feat).delay(300).fadeOut(300);
                }
                $(this).css({'background-image': 'url('+src+')'});
            }else{
              $(this).css({'background-image':'url('+src+')', 'background-color':$(this).css('background-color')});
              if(feat.length > 0) {
                $(feat).delay(300).fadeOut(300);
              }
            }
          }
        });
      }

      //Basic Collapse toggle for dropdowns and toggle menus
      $('[data-toggle="collapse"]').on('click', function(e) {
        e.preventDefault();
        //if target element is not open already
        //find all open collapse elements and close them
        if ( !$(this).is('.collapsed') ) {
          if ( $('.collapsed[data-toggle="collapse"]').length > 0 ) {
            $('.collapsed[data-toggle="collapse"]').each(function(){
              $(this).trigger('click');
            });
          }
        }
        var target = $(this).data('target');
        $(this).toggleClass('collapsed');
        $(target).toggleClass('collapsed');
      });

      /*
       * Collapse specificially for the nav. Utilizes .slideToggle()
       * for sliding animation for a more "out of the box" nice looking
       * mobile animation. Can easily be removed or altered for
       * more specific funcitonality.
       */
      $('[data-nav="collapse"]').on('click', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $(this).toggleClass('open');
        // $(target).toggleClass('collapsed');
        if( $(target).hasClass('active') ) {
          $(target).animate({'height': 0}, 150, function(){
            $(target).removeClass('active').removeAttr('style');
            $('body').removeClass('locked');
          });
        }else{
          $('body').addClass('locked');
          $(target).animate({'height': '100vh'}, 300, function(){
            $(target).addClass('active').removeAttr('style');
          });
        }
      });

      $(document).click(function(e) {
          //close all [data-toggle="collapse"] elements if
          //target doesn't have any data attributes defined or
          //if the target is does not have a data-toggle and
          //it does not have a data-content and
          //then make sure that the target is not a child of data-content="collapse"
          if (
            ( $(e.target).data('toggle') === undefined || $(e.target).data('toggle') === false ) &&
            ( $(e.target).data('content') === undefined || $(e.target).data('content') ===  false ) &&
            !$(e.target).parents( '[data-content="collapse"]' ).length
            ) {
            $('.collapsed[data-toggle="collapse"]').each(function(e){
              $(this).trigger('click');
            });
        }
      });

      /*
       * Address Autocompletes
       */

      if ( typeof google !== "undefined" && google.maps.places ) {

        // Organizes Info
        var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'short_name',
          country: 'long_name',
          postal_code: 'short_name'
        };

        /*
          Gravity Forms
         */

        if ( $('div.ginput_container_address').length > 0 ) {
          var gformAddressAutocomplete = new google.maps.places.Autocomplete($("span.address_line_1 input")[0], {});

          google.maps.event.addListener(gformAddressAutocomplete, 'place_changed', function() {
            var place = gformAddressAutocomplete.getPlace();
            var street_address = '';

            for (var i = 0; i < place.address_components.length; i++) {
              var addressType = place.address_components[i].types[0];
              if ( componentForm[addressType] ) {
                var val = place.address_components[i][componentForm[addressType]];

                if ( addressType === 'street_number' || addressType === 'route' ) {
                  street_address += val + ' ';
                  $("span.address_line_1 input").val(street_address);
                } else if ( addressType === 'locality' ) {
                  $("span.address_city input").val(val);
                } else if ( addressType === 'administrative_area_level_1' ) {
                  $("span.address_state input").val(val);
                } else if ( addressType === 'postal_code' ) {
                  $("span.address_zip input").val(val);
                } else if ( addressType === 'country' ) {
                  $("span.address_country select").val(val).trigger('change');
                }
              }
            }
          });
        }

      } // --end Address Autocomplete

    },


    finalize: function() {

    }
  };

  app.registerComponent( 'common', COMPONENT );
} )( app );
