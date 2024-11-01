//NuvuScroll  - 2011 - A jQuery Plugin. NRC Studios - http://nuvushift.nrcstudios.info written by: Nolan R Campbell - nuvuscripts@gmail.com
(function($){


     $.fn.nuvuscroll = function( options ) {
      //set document width and height



		// default options
		options = $.extend({

          direction: 'vertical',
          triggersize : 200,
          speed : 6,
          trailspeed: 1000,
          traildist: 20,
          traileasing: 'swing',
          keypress: 'true',

		}, options);

    return this.each(function() {

      var plake = $(this);
      var o = $.metadata ? $.extend({}, options, plake.metadata()) : options;
      var scroll = plake.find('.scroll');

 plake.mouseout(function(){ scroll.stop()}) ;
         //start if vertical
 if(options.direction == 'vertical') {

           var thisw = plake.width();
           var thish = plake.height();
           var thisx = plake.position().left;
           var thisy = plake.position().top;
        //set hover elements to position within targeted element
 if(options.triggersize != "custom"){

  plake.find('.hovtopleft').css({

    'top' : '0px',
    'left' : '0px',
    'width' : thisw,
    'height' : o.triggersize + 'px',

    });
  plake.find('.hovbottomright').css({

    'bottom' : '0px',
    'left' : '0px',
    'width' : thisw,
    'height' : o.triggersize + 'px',

    });
    };
    //top hover function
  plake.find('.hovtopleft').hover(function(){
    plake.find('.scroll').stop();
    var top = plake.find('.scroll').position().top;

       //looping animation up function
    (function up(){

      if(plake.find('.scroll').position().top >= -10){ var thist = plake.find('.scroll').position().top;   plake.find('.scroll').stop(); plake.find('.scroll').css({'top' : (thist - 10)})};
      var top = plake.find('.scroll').position().top;
      plake.find('.scroll').animate({
      'top' : top + o.speed
    },{duration:0.01, easing:'linear', complete: up})

    })(); //end up function
   }, function(){

      var thistop = scroll.position().top;
      //animate scroll out
      scroll.animate({'top' : thistop - o.traildist},{duration:o.trailspeed, easing: o.traileasing, queue: 'true'});

   }); // end top hover function


      // bottom hover function
   plake.find('.hovbottomright').hover(function(){
     scroll.stop();

     var top = scroll.position().top;
         //loop animation down function
  (function down(){
       if(scroll.position().top <= ('-' + (scroll.height() - plake.height()))){
           var thist = scroll.position().top;
           scroll.stop(); scroll.css({'top' : (thist + 10)});
};
       var top = scroll.position().top;
          scroll.animate({
             'top' : top - o.speed
             },{duration:0.01, easing:'linear', complete: down});
    })(); //end down function
   }, function(){
       var thistop = scroll.position().top;
       // animate scroll out
       scroll.animate({'top' : thistop + o.traildist},{duration:o.trailspeed, easing: o.traileasing, queue: 'true'});
   });

   //vertical up and down keypress function
   if(options.keypress == 'true'){
      $(document).keydown(function(e) {
    // animate functions for mouse and key events
 function animateup(){  scroll.stop();

       if(scroll.position().top <= ('-' + (scroll.height() - plake.height()))){
           var thist = scroll.position().top;
           scroll.stop(); scroll.css({'top' : (thist + 10)});

         };//end if
       var top = scroll.position().top;
          scroll.animate({
             'top' : top - o.speed
              },{duration:0.01, easing:'linear'});
      e.preventDefault();};//end animateup function

 function animatedown(){  scroll.stop();


      if(scroll.position().top >= -10){ var thist = scroll.position().top;   scroll.stop(); scroll.css({'top' : (thist - 10)})};
      var top = scroll.position().top;
      scroll.animate({
          'top' : top + o.speed
           },{duration:0.01, easing:'linear'})



    e.preventDefault();};  //end animatedown function


     //if key up arrow
   if(e.keyCode == 38 ) {

      animatedown();
       e.preventDefault();

       }
     //if key down arrow
   else if(e.keyCode == 40 ) {

      animateup();
      e.preventDefault();
       };

  });//end keydown function

  };  // end vertical keypress function
   }//end if vertical


 // start horizontal option

  if(options.direction == 'horizontal') {
    //vars
        var thisw = plake.width();
        var thish = plake.height();
        var thisx = plake.position().left;
        var thisy = plake.position().top;
  //set hover buttons css
 if(options.triggersize != "custom"){
  plake.find('.hovtopleft').css({

    'top' : '0px',
    'left' : '0px',
    'width' : o.triggersize + 'px',
    'height' : thish,

    });
     plake.find('.hovbottomright').css({

    'right' : '0px',
    'top' : '0px',
    'width' : o.triggersize + 'px',
    'height' : thish,

    });
    };


    var docwidth = $(document).width();
  $('.fsthumbs').width( docwidth);

  var flnumimages =  $('.fsthumbs .flickr-image').length;
   var fsmargin = ((parseInt($('.fsthumbs .flickr-image').css('margin-left'),10)*2)*flnumimages);
   console.log(fsmargin);
  var flwidth = $('.fsthumbs .flickr-image').width();
  $('.fsthumbs .scroll').css({'width':(flwidth*flnumimages)+fsmargin});
    //hoverleft function
    plake.find('.hovtopleft').hover(function(){
          scroll.stop();
          var left = scroll.position().left;
    //animate loop function scrollleft
   (function scrollright(){
            if(scroll.position().left <= '-' + ( (flwidth*flnumimages)+fsmargin - docwidth)){ var thisl = scroll.position().left;    scroll.stop(); scroll.css({'left' : (thisl - 10)}); console.log(thisl);}else{

            var left = scroll.position().left;
        scroll.animate({
            'left' : left - o.speed,

            },{duration:0.01, easing:'linear', complete: scrollright}); }

    })();
   }, function(){

      var thisleft = scroll.position().left;
      //animate scroll out
      scroll.animate({'left' : thisleft + o.traildist},{duration:o.trailspeed, easing: o.traileasing, queue: 'true'});

   });  //end hover left

   plake.find('.hovbottomright').hover(function(){
          scroll.stop();

          var left = scroll.position().left;

     //animate loop function scrollright
   (function scrollleft(){

      if(scroll.position().left >= 0){ var thisl = scroll.position().left;  scroll.stop(); scroll.css({'left' : '0px'})};
      var left = scroll.position().left;
      scroll.animate({
      'left' : left + o.speed,
    },{duration:0.01, easing:'linear', complete: scrollleft})

    })();
   }, function(){
         var ul = '#spinwrap ul';
         var thisleft = scroll.position().left;
      // animate scroll out
        if(scroll.position().left <= '-' + o.traildist) { var thisl = scroll.position().left; scroll.animate({'left' : thisleft - o.traildist},{duration:o.trailspeed, easing: o.traileasing, queue: 'true'}); };


   }); //end hover right

      //vertical up and down keypress function
   if(options.keypress == 'true'){   $(document).keydown(function(e) {
     //if key left arrow
  if(e.keyCode == 37) {
       scroll.stop();
       if(scroll.position().left <= '-' + ( scroll.width() - plake.width())){ var thisl = scroll.position().left;    scroll.stop(); scroll.css({'left' : (thisl - 10)})};
      var left = scroll.position().left;
      scroll.animate({
      'left' : left - o.speed,
    },{duration:0.01, easing:'linear'})
    e.preventDefault();


  }
  // if key right
  else if(e.keyCode == 39) { // right
       scroll.stop();
       if(scroll.position().left >= 0){ var thisl = scroll.position().left;  scroll.stop(); scroll.css({'left' : '0px'})};
       var left = scroll.position().left;
       scroll.animate({
           'left' : left + o.speed,
          },{duration:0.01, easing:'linear'})
      e.preventDefault();
  }; });
  };



   }//end if horizontal



      });  //end return each

       $(window).resize(function(e){
        docWidth  = $(window).width()
        docHeight = $(window).height()
      });




     };//end each























  })(jQuery)

