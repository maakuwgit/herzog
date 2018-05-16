( function( app ) {


  var COMPONENT = {

    init: function() {
      var _this = this;

      // Set the target
      var target = '.navbar';
      // Get dark bg element offset information
      var navRectangle = $( target )[0].getBoundingClientRect();

      function checkForDarkBackground(e) {
        // Flag
        var insideDarkBackground = false;

        // Loop through each dark bg element and check if nav element is inside it
        $( '.light-bg' ).each( function( index, element ) {

          // Get dark bg element offset information
          elementRectangle = element.getBoundingClientRect();

          // Check if the nav element is inside of the dark bg element
          var overlap = !(navRectangle.bottom < elementRectangle.top ||
                          navRectangle.top > elementRectangle.bottom);

          // Overlap found, set flag true
          if ( overlap ) {
            insideDarkBackground = true;
          }
        });

        // Check if flag successful
        if ( insideDarkBackground ) {
          // Menu was inside a dark bg, add class
          $( target ).addClass( 'navbar--dark' );
          //return;
        } else {
          // Menu was not inside a dark bg, remove class
          $( target ).removeClass( 'navbar--dark' );
        }
      }

      checkForDarkBackground( false );

      $( document ).on( 'scroll.checkForDarkBackground', checkForDarkBackground);

    },

    finalize: function() {
      var _this = this;
    }
  };

  app.registerComponent( 'nav-scroll', COMPONENT );
} )( app );
