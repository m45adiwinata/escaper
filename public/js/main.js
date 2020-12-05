jQuery(document).ready(function($) {

	"use strict";
	
	var siteSticky = function() {
		$(".js-sticky-header").sticky({topSpacing:0});
	};
	siteSticky();
	
	// navigation
  var siteScroll = function() {
  	$(window).scroll(function() {
  		var st = $(this).scrollTop();
  		if (st > 200) {
  			$('.js-sticky-header').addClass('transparency');
  		} else {
  			$('.js-sticky-header').removeClass('transparency');
  		}
  	}) 
  };
  siteScroll();

  /*$(".product-item").mouseenter(function(){       
    $("img",this).attr('src','images/pollock-half-zip2.jpg');      
  });   
  $(".product-item").mouseleave(function(){       
    $("img",this).attr('src','images/pollock-half-zip.jpg');      
  });  */
});
