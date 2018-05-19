/**
* callout-numbers JS
* -----------------------------------------------------------------------------
*
* All the JS for the callout-numbers component.
*/
( function( app ) {

  var COMPONENT = {

    className: 'callout-numbers',


    selector : function() {
      return '.' + this.className;
    },

    startCounter: function(target){
          max    = parseInt($(target).attr('data-count')),
          curr   = 0,
          incr   = max * 0.001;

      var countUp = setInterval(function(){
        if( curr < max ) {
          curr+=incr;
        }else{
          curr = max;
          clearInterval(countUp);
        }
        $(target).html(addCommas(curr));
      }, 1);
    },

    resetCounter: function(target){
      $(target).html('0');
    },

    // Fires after common.init, before .finalize and common.finalize
    init: function() {
      addCommas = function(num){
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      var _this   = this,
          callout = $("[data-component='"+_this.className+"']"),
          counter = $(callout).find('[data-count]');
    },


    finalize: function() {

      var _this = this;
    }
  };

  // Hooks the component into the app
  app.registerComponent( 'callout-numbers', COMPONENT );
} )( app );
