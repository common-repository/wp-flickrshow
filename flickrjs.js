     (function ($) {
   var thisimageurl;
   var thisa;
   var container;
    var innerposl;
   var innerpost;
    var limageinnerw;
  var limageinnerh;
     //preload large images
  $.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;

    });
};
    // Declare the array variable
    var imgSwap = [];
    // Select all images used in the image swap function - in our case class "img-swap"
  $(".flickr-image").find("a").each(function(){
        // Loop through all images which are used in our image swap function
        // Get the file name of the active images to be loaded by replacing _off with _on
        imgUrl = this.href.replace("_off","_on");

        // Store the file name in our array
        imgSwap.push(imgUrl);
    });



    // Pass the array to our preload function
   if($('.flickrshowwrap').attr('preload')== 'true'){   $(imgSwap).preload();
   };

   //flickrshow click hide animation

   //append flickrshow div to body
   $('body').append("<div class='flickrshow' ><div class='flickrbg'></div><div class='fsthumbs' > <div class='hovtopleft'><span class='spanleft'></span></div><div class='flickrshowwrap scroll'></div><div class='hovbottomright'><span class='spanright'></span></div></div><div class='fstitle'></div><div class='fszoom'><div class='fszoomin'>+</div><div class='fszoomout'>-</div></div></div>");

  //add fsthumbs flicker-images content
  var total;
    $(document).find(".flickr-image").each(function() {

    total += "<div class='flickr-image' >" + $(this).html() + "</div>";
  });
  $('.fsthumbs').find('.flickrshowwrap').html(total);
  var fstotal = 0;
    $('.flickrshowwrap').find(".flickr-image").each(function() {

    fstotal ++ ;
  });
  var fsimagew =  $('.fsthumbsinner').find(".flickr-image").width();
  $('.fsthumbsinner').css({'width': (fsimagew*fstotal)});
  var flickrshow = $('.flickrshow');
  flickrshow.hide();

   //bind click event to pictures
   $('.fimg').live('click' , function(e){e.preventDefault();});
  $(".flickr-image").live('click', function(e){

    container = $(this).parent();
    $('.selectedimage').removeClass('selectedimage');
   thisa =  $(this).find("a").parent();
    $(this).addClass('selectedimage');
   thisimageurl = $(this).find("a").attr('href');
   var thisimageviews = $(this).find("a").attr('views');
   var thisimageuser = $(this).find("a").attr('user');
   var thisimagetitle = $(this).find("a").attr('title');


   if(thisimagetitle == ""){thisimagetitle = "Untitled"};
   flickrshow.find('.limageinner').addClass('old');
   flickrshow.find('.picinfo').addClass('old');
   var showinfo = $(".flickr-image").find('a').attr('showinfo');
   if (showinfo == "false"){
     $('.prevbutton, .limage, .nextbutton').addClass('oldimage');
      flickrshow.append("<div class='prevbutton'><div class='previmg'></div></div><div class='limage'><a href='http://flickrshow.nrcstudios.info'><div class='getlogo'></div></a><div class='limageover'><div class='fslogo'></div></div><img class='limageinner' src='" + thisimageurl + "' /></div><div class='nextbutton'><div class='nextimg'></div></div>");
   }else if(showinfo == "true"){
     $('.prevbutton, .limage, .nextbutton, .picinfo').addClass('oldimage');
   flickrshow.append("<div class='prevbutton'><div class='previmg'></div></div><div class='limage'><div class='limageover'><div class='fslogo'></div></div><img class='limageinner' src='" + thisimageurl + "' /><div class='imageoverlay'></div><div class='picinfo'><ul><li class='odd'>Title: </li><li class='even' id='imagetitle' >"+thisimagetitle+"</li><li class='odd'>Views:</li><li id='imageviews' class='even'> "+thisimageviews+"</li><li class='odd'>Username:</li><li id='imageuser' class='even'> "+thisimageuser+"</li></ul><a href='http://flickrshow.nrcstudios.info'><div class='getlogo'></div></a></div></div><div class='nextbutton'><div class='nextimg'></div></div>");
   };
   //add thumbbar at bottom


   var picinfo = $('.picinfo');
   //var imageh = $(".limage").css('height');
    var imageh = $(".limage").height();
     var imagew = $(".limage").width();
   var picinfohalfw = picinfo.height()/2;
   var offset = parseInt($('.limage').css('borderLeftWidth'),10);
   var offsetTop = parseInt($('.limage').css('borderTopWidth'),10);


   //var imagew = $(".limage").css('width');
    $(".limageover").css({'height' : imageh, 'width' : imagew});
    docWidth  = $(window).width();
        docHeight = $(window).height();
      var imageoh =  $(".limageover").height();
        var imageow = $(".limageover").width();
        var logow = $('.fslogo').width();
         var logoh = $('.fslogo').height();
    var logopostop = ((  imageoh - logoh ) / 2)+(logoh/2) ;
   var logoposleft =  (( imageow - logow ) / 2);
   var limage =  $(".limage");
  var fslogo = $(".fslogo");
  var limageover = $(".limageover");
   var postop = (( docHeight -  imageh ) / 2)-offsetTop ;
   var posleft =  (( docWidth -  imagew ) / 2)-offset;
   var picinfoh = picinfo.height();
   var limageinner = $('.limageinner');
    fslogo.css({"top":  logopostop });
    fslogo.css({"left":  logoposleft });
     limage.css({"top":  postop });
    limage.css({"left":  posleft });


    var prevbutton = $('.prevbutton');
    var nextbutton = $('.nextbutton');
     prevbutton.css({"top": ((postop+(imageh/2))-(prevbutton.height()/2))+offsetTop, "left":  posleft-(prevbutton.width()/2) });
     nextbutton.css({"top": (postop+(imageh/2)-(nextbutton.height()/2))+offsetTop, "left":  ((posleft+imagew)- (nextbutton.width()/2))+(offset*2)});

     var old =  $('.old');
     var oldimage =  $('.oldimage');
     var flickrbg =   $('.flickrbg');
      picinfo.stop().delay(4000).animate({'opacity' : '0.7'},{duration : 3000});
      $('.oldimage .limageinner').animate({'opacity' : '0'},{duration:2000});
       oldimage.stop().delay(2000).animate({'opacity' : '0'},{duration : 6000, complete: function(){ oldimage.remove();}});
      old.stop().animate({'opacity' : '0'},{duration : 4000, complete: function(){ old.remove();}});
     flickrshow.stop().animate({'opacity' : '1', 'visibility' : 'visible'},{duration : 2000}).show();
     prevbutton.stop().delay(3000).animate({'opacity' : '1'},{duration : 2000});
     nextbutton.stop().delay(3000).animate({'opacity' : '1'},{duration : 2000});
     flickrbg.stop().animate({'opacity' : '0'},{duration:1000, complete:function(){ flickrbg.css({'background-image' : 'url(' + thisimageurl + ')'}); flickrbg.stop().animate({'opacity' : '0.5'},{duration:6000});}});

    flickrshow.css({'visibility' : 'visible'});
   limage.delay(1000).animate({ 'opacity' : '1'},{duration : 5000});
    limageinner.delay(1000).animate({ 'opacity' : '1'},{duration : 5000});



   //trigger autoplay

    innerposl = $('.limageinner').position().left;
   innerpost = $('.limageinner').position().top;
     limageinnerw =  $('.limageinner').width();
  limageinnerh =  $('.limageinner').height();

  });
  /*fsthumbs opacity toggle
 $('.flickrshow').live('mouseover', function(){
 $('.fsthumbs .flickrshowwrap .flickr-image').stop().animate({'margin-left' : '2.5px', 'margin-right' : '2.5px'},{duration:1000});
 });
  $('.flickrshow').live('mouseleave', function(){
 $('.fsthumbs .flickrshowwrap .flickr-image').stop().animate({'margin-left' : '-30px', 'margin-right' : '0px'},{duration:1000});

 }); */



 /*    jQuery.fn.nextOrFirst = function(selector){
    var next = this.next(selector);
    return (next.length) ? next : this.prevAll(selector).last();
} */

   //bind prev and next buttons
    $(".prevbutton").live('click', function(){

       var selectedimage = $('.selectedimage');
       var selcontp =  container;
       var hasfirst = selcontp.find('.flickr-image:first').hasClass('selectedimage');
      if(hasfirst){
      var prevselected =  selcontp.find('.flickr-image:last');  selectedimage.removeClass('selectedimage'); prevselected.addClass('selectedimage');
      }else{
      var prevselected =  selectedimage.prev('.flickr-image');  selectedimage.removeClass('selectedimage'); prevselected.addClass('selectedimage');
      };

       var imageuri = $('.selectedimage').find('a').attr('href');
        var imageviews = $('.selectedimage').find('a').attr('views');
       var imageuser = $('.selectedimage').find('a').attr('user');
       var imagetitle = $('.selectedimage').find('a').attr('title');
       var limage =  $('.limageinner');
       var flickrbg = $('.flickrbg');

        limage.attr('src', imageuri) ;
          if(imagetitle == ''){imagetitle = 'Untitled'};
            var picinfo = $('.picinfo');
            picinfo.stop().animate({'opacity' : '0'},{duration:2000, complete:function(){   $(this).animate({'opacity' : '0.5'},{duration: 2000});}}) ;
           limage.stop().animate({'opacity' : '0.1'},{duration:200, complete:function(){  limage.delay(2000).attr('src', imageuri) ; limage.animate({'opacity' : '1'},{duration: 2000});}}) ;

           $('#imageviews').text(imageviews);
           $('#imageuser').text(imageuser);

           $('#imagetitle').text(imagetitle);

      flickrbg.stop().animate({'opacity' : '0'},{duration:1000, complete:function(){ flickrbg.css({'background-image' : 'url(' + imageuri + ')'}); flickrbg.stop().animate({'opacity' : '0.5'},{duration:6000});}});


    });
    $(".nextbutton").live('click', function(e){

       var selectedimage = $('.selectedimage');
       var selcontp =  container;
       var haslast = selcontp.find('.flickr-image:last').hasClass('selectedimage');
      if(haslast){
      var prevselected =  selcontp.find('.flickr-image:first');  selectedimage.removeClass('selectedimage'); prevselected.addClass('selectedimage');
      }else{
      var prevselected =  selectedimage.next('.flickr-image');  selectedimage.removeClass('selectedimage'); prevselected.addClass('selectedimage');
      };





       var imageuri = $('.selectedimage').find('a').attr('href');
       var imageviews = $('.selectedimage').find('a').attr('views');
       var imageuser = $('.selectedimage').find('a').attr('user');
       var imagetitle = $('.selectedimage').find('a').attr('title');
       var limage =  $('.limageinner');
       var flickrbg = $('.flickrbg');
        if(imagetitle == ''){imagetitle = 'Untitled'};

        var picinfo = $('.picinfo');
        picinfo.stop().animate({'opacity' : '0'},{duration:2000, complete:function(){   $(this).animate({'opacity' : '0.5'},{duration: 2000});}}) ;

      limage.stop().animate({'opacity' : '0.1'},{duration:200, complete:function(){  limage.delay(2000).attr('src', imageuri) ; limage.animate({'opacity' : '1'},{duration: 2000});}}) ;


        $('#imageviews').text(imageviews);
        $('#imageuser').text(imageuser);
        $('#imagetitle').text(imagetitle);

      flickrbg.stop().animate({'opacity' : '0'},{duration:1000, complete:function(){ flickrbg.css({'background-image' : 'url(' + imageuri + ')'}); flickrbg.stop().animate({'opacity' : '0.5'},{duration:6000});}});


    });
  //mouseover and out functions
   $(".flickrshowwrap").live('mouseover', function(e){

       $(this).find(".fimg").addClass('lowopacity');
   });
   $(".flickrshowwrap").live('mouseleave', function(){
       $(this).find(".fimg").removeClass('lowopacity');
        $(this).find(".fimg").removeClass('highopacity');

   });
  $(".fimg").live('mouseover' , function(){

      $(this).addClass('highopacity');

  });



$('.flickrbg').live('click' , function hidebox(){

    //$(this).animate({'width' : '500%', 'height' : '500%', 'left' :'-200%', 'top' : '-100%'},{duration:2000});
     $('.flickrshow').stop().animate({'opacity' : '0', 'visibility' : 'hidden'},{duration : 6000, complete: function(){ $(this).hide();}});
     $(this).stop().animate({'width' : '500%', 'height' : '500%', 'left' :'-200%', 'top' : '-200%', 'opacity' : '0'},{duration : 6000, complete:function(){ $(this).stop().css({'width' : '100%', 'height' : '100%', 'top' : '0px', 'left' : '0px'});}});
     var picinfo = $('.picinfo');
     var prevbutton = $('.prevbutton');
    var nextbutton = $('.nextbutton');
     picinfo.stop().animate({'opacity' : '0'},{duration : 2000, complete: function(){$(this).remove()}});
     prevbutton.stop().animate({'opacity' : '0'},{duration : 2000});
     nextbutton.stop().animate({'opacity' : '0'},{duration : 2000});

   });
   var limagew =  $('.limage').width();
  var limageh =  $('.limage').height();

 $('.fszoomin').live('click', function(e){
  var limagew =  $('.limage').width();
  var limageh =  $('.limage').height();
  var limageinnerw =  $('.limageinner').width();
  var limageinnerh =  $('.limageinner').height();
  var posl =  $('.limageinner').position().left - $('.limageinner').offset().left;
  var postop =  $('.limageinner').position().top - $('.limageinner').offset().top;
  var tenpercentw = limageinnerw*0.1;
 var tenpercenth = limageinnerh*0.1;


      $('.limageinner').stop().animate({'border': '1px solid #777', 'width': $(window).width(), 'height' : $(window).height(), 'top' : postop+$(window).scrollTop(), 'left' :  posl},{duration:1000});
      $('.limageinner').css({'z-index' : '99999999999'});

   /*var flickrbg = $('.flickrbg');
   flickrbg.css({'z-index' : '999997'});
   flickrbg.animate({'opacity' : '1'});
   */
   });

   $('.fszoomout').live('click', function(e){
     var limagew =  $('.limage').width();
  var limageh =  $('.limage').height();


      $('.limageinner').stop().animate({'border': '0px solid #777','width': limagew, 'height' : limageh, 'top' : '0px', 'left' : '0px' },{duration:2000,complete:function(){ $('.limageinner').css({'z-index' : '999998'});}});

  /* var flickrbg = $('.flickrbg');
    flickrbg.css({'z-index' : '999995'});
   flickrbg.animate({'opacity' : '0.4'});
   */
   });

//window resize animation
   $(window).resize(function(e){
      var imageh = $(".limage").height();
   var imagew = $(".limage").width();
        thisWidth  = $(window).width();
        thisHeight = $(window).height();
         var offset = parseInt($('.limage').css('borderLeftWidth'),10);
         var offsetTop = parseInt($('.limage').css('borderTopWidth'),10);
          postop = (( thisHeight -  imageh ) / 2)-offsetTop ;
    posleft =  (( thisWidth -  imagew ) / 2)-offset;
     var picinfo = $('.picinfo');
   var picinfoh = picinfo.height();
   var picinfohalfw = picinfo.height()/2;
   var offset = parseInt($('.limage').css('borderLeftWidth'),10);
   var offsetTop = parseInt($('.limage').css('borderTopWidth'),10);
   var fsthumbs = $('.fsthumbs');
    $(".limage").stop().animate({"top":  postop,"left":  posleft , 'opacity' : '1' },{duration:2000});


      var prevbutton = $('.prevbutton');
    var nextbutton = $('.nextbutton');
    prevbutton.stop().animate({"top": ((postop+(imageh/2))-(prevbutton.height()/2))+offsetTop, "left":  posleft-(prevbutton.width()/2) },{duration:2000});
     nextbutton.stop().animate({"top": (postop+(imageh/2)-(nextbutton.height()/2))+offsetTop, "left":  ((posleft+imagew)- (nextbutton.width()/2))+(offset*2)},{duration:2000});
     fsthumbs.stop().animate({'width':thisWidth});
     fsthumbs.css({'overflow' : 'visible'});
      });






 $('.fsthumbs .flickrshowwrap .flickr-image').live('mouseover', function(e){
   $(this).css({'margin-top' : '-13px'});
   $(this).next().css({'margin-top' : '-8px'});
    $(this).next().next().css({'margin-top' : '-5px'});
   $(this).prev().css({'margin-top' : '-8px'});
   $(this).prev().prev().css({'margin-top' : '-5px'});
    var imagetitle = $(this).find('a').attr('title');
    var titlew = $(this).find('a').attr('title').length;
    if(imagetitle == ""){imagetitle = "Untitled";
    titlew = 8} ;
     var fstitle =  $('.fstitle');

     fstitle.html("<div class='fstitlel'></div>:: " +imagetitle+" ::");
     var fstitlel = $('.fstitlel');
     var fonts =  parseInt(fstitle.css('font-size'),10);
     var windowwhalf = ($(window).width()/2);
     var titlepfonts = (titlew*fonts);

     if(e.clientX > windowwhalf){
       fstitle.stop().animate({'left' : e.clientX-titlepfonts, 'opacity' : '1', 'width' : titlepfonts+'px'},{duration:1000});

        } else {
           fstitle.stop().animate({'left' : e.clientX, 'opacity' : '1', 'width' : (titlew*fonts)+'px'},{duration:1000});

            }
     console.log(titlew);
 });

$('.fsthumbs .flickrshowwrap .flickr-image').live('mouseleave', function(e){
  $('.fsthumbs .flickrshowwrap .flickr-image').css({'margin-top' : '0px'});
   $('.fstitle').stop().animate({'opacity' : '0'},{duration:1000});

 });


//nuvuscroll code
  $('.fsthumbs').nuvuscroll({
      direction: 'horizontal',
      triggersize: "custom",
      speed: 30,
      trailspeed: 1,
       traildist: 10,
       traileasing: 'linear',
       keypress: 'true',

    });


})(jQuery) ;