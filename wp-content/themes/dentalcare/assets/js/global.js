/*-------------------------------------------------------------------------------------------------------------------------------*/
/*This is main JS file that contains custom style rules used in this template*/
/*-------------------------------------------------------------------------------------------------------------------------------*/
/* Template Name: "Title"*/
/* Version: 1.0 Initial Release*/
/* Build Date: 06-02-2016*/
/* Author: Title*/
/* Copyright: (C) 2016 */
/*-------------------------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------*/
/* TABLE OF CONTENTS: */
/*--------------------------------------------------------*/
/* 01 - VARIABLES */
/* 02 - page calculations */
/* 03 - function on document ready */
/* 04 - function on page load */
/* 05 - function on page resize */
/* 06 - function on page scroll */
/* 07 - swiper sliders */
/* 08 - buttons, clicks, hovers */

var _functions = {};

jQuery(function() {

	"use strict";	

	/*================*/
	/* 01 - VARIABLES */
	/*================*/
	var swipers = [], winW, winH, headerH, winScr, footerTop, _isresponsive, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

	/*========================*/
	/* 02 - page calculations */
	/*========================*/
	_functions.pageCalculations = function(){
		winW = jQuery(window).width();
		winH = jQuery(window).height();
	};

	/*=================================*/
	/* 03 - function on document ready */
	/*=================================*/
	if(_ismobile) jQuery('body').addClass('mobile');
	_functions.pageCalculations();

	/*============================*/
	/* 04 - function on page load */
	/*============================*/
	jQuery(window).load(function(){
		_functions.initSwiper();
		jQuery('body').addClass('loaded');
		jQuery('#loader-wrapper').fadeOut();
	});

	/*==============================*/
	/* 05 - function on page resize */
	/*==============================*/
	_functions.resizeCall = function(){
		_functions.pageCalculations();
	};
	if(!_ismobile){
		jQuery(window).resize(function(){
			_functions.resizeCall();
		});
	} else{
		window.addEventListener("orientationchange", function() {
			_functions.resizeCall();
		}, false);
	}

	/*==============================*/
	/* 06 - function on page scroll */
	/*==============================*/
	jQuery(window).scroll(function(){
		_functions.scrollCall();
	});

	_functions.scrollCall = function(){
		winScr = jQuery(window).scrollTop();

		if (winScr > 30){
			jQuery(".tt-header").addClass("stick fadeInDown animated");
		} else {
			jQuery(".tt-header").removeClass("stick fadeInDown animated");
		}
		
	};
	
	/*=====================*/
	/* 07 - swiper sliders */
	/*=====================*/
	var initIterator = 0;
	_functions.initSwiper = function(){
		jQuery('.swiper-container').not('.initialized').each(function(){								  
			var jQueryt = jQuery(this);								  

			var index = 'swiper-unique-id-'+initIterator;

			jQueryt.addClass('swiper-'+index+' initialized').attr('id', index);
			jQueryt.find('.swiper-pagination').addClass('swiper-pagination-'+index);
			jQueryt.find('.swiper-button-prev').addClass('swiper-button-prev-'+index);
			jQueryt.find('.swiper-button-next').addClass('swiper-button-next-'+index);

			var slidesPerViewVar = (jQueryt.data('slides-per-view'))?jQueryt.data('slides-per-view'):1;
			if(slidesPerViewVar!='auto') slidesPerViewVar = parseInt(slidesPerViewVar, 10);

			swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
				pagination: '.swiper-pagination-'+index,
		        paginationClickable: true,
		        nextButton: '.swiper-button-next-'+index,
		        prevButton: '.swiper-button-prev-'+index,
		        slidesPerView: slidesPerViewVar,
		        autoHeight:(jQueryt.is('[data-auto-height]'))?parseInt(jQueryt.data('auto-height'), 10):0,
		        loop: (jQueryt.is('[data-loop]'))?parseInt(jQueryt.data('loop'), 10):0,
				autoplay: (jQueryt.is('[data-autoplay]'))?parseInt(jQueryt.data('autoplay'), 10):5000,
		        breakpoints: (jQueryt.is('[data-breakpoints]'))? { 767: { slidesPerView: parseInt(jQueryt.attr('data-xs-slides'), 10) }, 991: { slidesPerView: parseInt(jQueryt.attr('data-sm-slides'), 10) }, 1199: { slidesPerView: parseInt(jQueryt.attr('data-md-slides'), 10) } } : {},
		        initialSlide: (jQueryt.is('[data-ini]'))?parseInt(jQueryt.data('ini'), 10):0,
		        speed: (jQueryt.is('[data-speed]'))?parseInt(jQueryt.data('speed'), 10):500,
		        keyboardControl: true,
		        mousewheelControl: (jQueryt.is('[data-mousewheel]'))?parseInt(jQueryt.data('mousewheel'), 10):0,
		        mousewheelReleaseOnEdges: true,
		        spaceBetween: (jQueryt.is('[data-space-between]'))?parseInt(jQueryt.data('space-between'), 10):0,
		        direction: (jQueryt.is('[data-direction]'))?jQueryt.data('direction'):'horizontal',
				onSlideChangeEnd: function(swiper){
					var animationBlocks = jQueryt.find('.swiper-slide-active .text-animation');
					for (var i = 0; i < animationBlocks.length; ++i ){
						jQuery(animationBlocks[i]).addClass('animated ' + jQuery(animationBlocks[i]).attr("data-animation"));
					}
				},		        
				onSlideChangeStart: function(swiper){
					var animationBlocks = jQueryt.find('.swiper-slide-active .text-animation');
					for (var i = 0; i < animationBlocks.length; ++i ){
						jQuery(animationBlocks[i]).removeClass('animated ' + jQuery(animationBlocks[i]).attr("data-animation"));
					}
				},		        
			});
			swipers['swiper-'+index].update();
			initIterator++;
		});
		jQuery('.swiper-container.swiper-control-top').each(function(){
			swipers['swiper-'+jQuery(this).attr('id')].params.control = swipers['swiper-'+jQuery(this).parent().find('.swiper-control-bottom').attr('id')];
		});
		jQuery('.swiper-container.swiper-control-bottom').each(function(){
			swipers['swiper-'+jQuery(this).attr('id')].params.control = swipers['swiper-'+jQuery(this).parent().find('.swiper-control-top').attr('id')];
		});
	};

	/*==============================*/
	/* 08 - buttons, clicks, hovers */
	/*==============================*/

	//menu
	jQuery('.cmn-toggle-switch').on('click', function(e){
		jQuery(this).toggleClass('active');
		jQuery(this).parents('header').find('.toggle-block').slideToggle();
		e.preventDefault();
	});
	jQuery('.main-nav .menu-toggle').on('click', function(e){
		jQuery(this).closest('li').toggleClass('select').siblings('.select').removeClass('select');
		jQuery(this).closest('li').siblings('.parent').find('ul').slideUp();
		jQuery(this).closest('a').siblings('ul').slideToggle();
		e.preventDefault();
	});

	
	/*tt-load-more*/
	jQuery('.tt-load-more').on('click', function(e){
		var jQuerycloneHtml = jQuery(this).closest('.tt-block').find('.row:first-child').clone();
		jQuery(this).parent().prev().prev().append(jQuerycloneHtml)
	  	e.preventDefault();        		
	});

    //Tabs
	var tabFinish = 0;
	jQuery('.tt-nav-tab-item').on('click', function(e){		
	    var jQueryt = jQuery(this);
	    if(tabFinish || jQueryt.hasClass('active')) e.preventDefault();
	    tabFinish = 1;
	    jQueryt.closest('.tt-nav-tab').find('.tt-nav-tab-item').removeClass('active');
	    jQueryt.addClass('active');
	    var index = jQueryt.parent().parent().find('.tt-nav-tab-item').index(this);
	    jQueryt.parents('.tt-tab-wrapper').find('.tt-tab-select select option:eq('+index+')').prop('selected', true);
	    jQueryt.closest('.tt-tab-wrapper').find('.tt-tab-info:visible').fadeOut(500, function(){
	    	var jQuerytabActive  = jQueryt.closest('.tt-tab-wrapper').find('.tt-tab-info').eq(index);
	    	jQuerytabActive.css('display','block').css('opacity','0');
	    	jQuerytabActive.animate({opacity:1});
	    	 tabFinish = 0;
	    });
	});
	jQuery('.tt-tab-select select').on('change', function(e){
	    var jQueryt = jQuery(this);
	    if(tabFinish) e.preventDefault();
	    tabFinish = 1;    
	    var index = jQueryt.find('option').index(jQuery(this).find('option:selected'));
	    jQueryt.closest('.tt-tab-wrapper').find('.tt-nav-tab-item').removeClass('active');
	    jQueryt.closest('.tt-tab-wrapper').find('.tt-nav-tab-item:eq('+index+')').addClass('active');
	    jQueryt.closest('.tt-tab-wrapper').find('.tt-tab-info:visible').fadeOut(500, function(){
	    	var jQuerytabActive  = jQueryt.closest('.tt-tab-wrapper').find('.tt-tab-info').eq(index);
	    	jQuerytabActive.css('display','block').css('opacity','0');
	    	jQuerytabActive.animate({opacity:1});
	    	 tabFinish = 0;
	    });
	});

	/*tabs from hash*/
	var hash = location.hash.replace('#', '');
	if(hash){
		hashTab();
	}
	function hashTab(){
		var jQuerytabSel = jQuery('.tt-nav-tab-item[data-tab="' +hash+ '"]').addClass('active');
	    jQuerytabSel.closest('.tt-nav-tab').find('.tt-nav-tab-item').removeClass('active');
	    jQuerytabSel.addClass('active');
	    var index = jQuerytabSel.parent().parent().find('.tt-nav-tab-item').index(jQuerytabSel);
	    jQuerytabSel.parents('.tt-tab-wrapper').find('.tt-tab-select select option:eq('+index+')').prop('selected', true);
	    jQuerytabSel.closest('.tt-tab-wrapper').find('.tt-tab-info:visible').fadeOut(500, function(){
	    	var jQuerytabActive  = jQuerytabSel.closest('.tt-tab-wrapper').find('.tt-tab-info').eq(index);
	    	jQuerytabActive.css('display','block').css('opacity','0');
	    	jQuerytabActive.animate({opacity:1});
	    });	
	}
	jQuery(window).on("hashchange", function() {
	    if(window.location.hash) {
	        hash = location.hash.replace('#', '');
	        hashTab();
	    }		
	});

	/* accordeon */
	jQuery('.tt-accordeon-title').on('click', function(){
		jQuery(this).closest('.tt-accordeon').find('.tt-accordeon-title').not(this).removeClass('active').next().slideUp();
		jQuery(this).toggleClass('active').next().slideToggle();
	});		

	/*submit form*/
	jQuery('form.tt-submit-form').on('submit',function(e){
	   submitShedule(jQuery(this));
	   e.preventDefault();
	});
    function submitShedule(jQueryform) {
        jQuery.ajax({type:'POST', url:'email-action.php', data:jQueryform.serialize(), success: function(response) {
           jQueryform.find('input[type="submit"]').html('sent');
           jQueryform.find('.tt-reply-success').html('Your message was sent successfully').addClass('active');
           jQueryform[0].reset();                               
        }});                
        return false;
    }

	/* 10 - counter */
    jQuery(function(){
    function setTimer(){                        
        var today = new Date();
        var finalTime = new Date("Sep,1,2018");
        var interval = finalTime - today;
        if(interval<0) interval = 0;
        var days = parseInt(interval/(1000*60*60*24));
        var daysLeft = interval%(1000*60*60*24);
        var hours = parseInt(daysLeft/(1000*60*60));
        var hoursLeft = daysLeft%(1000*60*60);
        var minutes = parseInt(hoursLeft/(1000*60));
        var minutesLeft = hoursLeft%(1000*60);
        var seconds = parseInt(minutesLeft/(1000));
        jQuery('.days').text(days);
        jQuery('.hours').text(hours);
        jQuery('.minutes').text(minutes);
        jQuery('.seconds').text((seconds<10)?'0'+seconds:seconds);
    }
    setTimer();
    setInterval(function(){setTimer();}, 1000);
	}); 
	

	/*=====================*/
	/* 12 - LIGHT-BOX */
	/*=====================*/

	var lightbox = '.lightbox';
	if(jQuery(lightbox).length){
		var instanceG = jQuery(lightbox).imageLightbox({
			quitOnDocClick:	false,
			onStart:		function() {arrowsOn(instanceG, lightbox);overlayOn(); closeButtonOn(instanceG);},
			onEnd:			function() {arrowsOff();captionOff(); overlayOff(); closeButtonOff(); activityIndicatorOff();},
			onLoadStart: 	function() {captionOff(); activityIndicatorOn();},
			onLoadEnd:	 	function() {jQuery('.imagelightbox-arrow').css('display', 'block');captionOn(); activityIndicatorOff();}
		});		
	}		
	
	/*activity indicator functions*/
	var activityIndicatorOn = function(){
		jQuery('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
	};
	var activityIndicatorOff = function(){
		jQuery('#imagelightbox-loading').remove();
	};
	
	/*close button functions*/
	var closeButtonOn = function(instance){
		jQuery('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function(){ jQuery(this).remove(); instance.quitImageLightbox(); return false; });
	};
	var closeButtonOff = function(){
		jQuery('#imagelightbox-close').remove();
	};
	
	/*overlay*/
	var overlayOn = function(){jQuery('<div id="imagelightbox-overlay"></div>').appendTo('body');};
	var overlayOff = function(){jQuery('#imagelightbox-overlay').remove();};
	
	/*caption*/
	var captionOff = function(){jQuery('#imagelightbox-caption').remove();};
	var captionOn = function(){
		var description = jQuery('a[href="' + jQuery('#imagelightbox').attr('src') + '"] img').attr('alt');
		if(description.length)
			jQuery('<div id="imagelightbox-caption">' + description +'</div>').appendTo('body');
	};

	/*arrows*/
    var arrowsOn = function(instance, selector) {
        var jQueryarrows = jQuery('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"><i class="fa fa-chevron-left"></i></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"><i class="fa fa-chevron-right"></i></button>');
        jQueryarrows.appendTo('body');
        jQueryarrows.on('click touchend', function(e) {
            e.preventDefault();
            var jQuerythis = jQuery(this);
            if( jQuerythis.hasClass('imagelightbox-arrow-left')) {
                instance.loadPreviousImage();
            } else {
                instance.loadNextImage();
            }
            return false;
        });
    };	
	var arrowsOff = function(){jQuery('.imagelightbox-arrow').remove();};	

    

});
jQuery(document).ready(function(jQuery){
	
	jQuery( "ul li.menu-item-has-children" ).addClass(function() {
		return "parent";
	});

});

jQuery('#btt').click(function() {    
    jQuery(window).scroll(function() {  
	if(jQuery(this).scrollTop() != 0) {    	
	jQuery('#btt').fadeIn();           		
	} else {       		
	jQuery('#btt').fadeOut();    
	}        	 
	});      
	jQuery('#btt').click(function() { 	
	jQuery('body,html').animate({scrollTop:0},800);  
	});
	
});

function mobileNavToggler () {
	if (jQuery('.nav-t-holder').length) {
		jQuery('.nav-t-holder .nav-t-header button').on('click', function () {
			jQuery('.nav-t-holder .nav-t-footer').slideToggle();
			return false;
		});
		jQuery('.nav-t-holder li.menu-item-has-children').children('a').append(function () {
			return '<button class="dropdown-expander"><i class="fa fa-chevron-down"></i></button>';    			
		});
		jQuery('.nav-t-holder .nav-t-footer .dropdown-expander').on('click', function () {
			var Self =  jQuery(this).parent().parent().children('.sub-menu');
			if(Self.hasClass('dopdown-nav-toggler-active'))
			{
				Self.removeClass('dopdown-nav-toggler-active');
				jQuery(".nav ul.sub-menu").fadeOut();
			}
			else
			{
				jQuery(".nav ul.sub-menu").fadeOut();
				jQuery(".nav ul.sub-menu").removeClass('dopdown-nav-toggler-active');
				Self.addClass('dopdown-nav-toggler-active');
				Self.slideToggle();
			}
			return false;
		});

	}
}
mobileNavToggler ();

function headerAnimation() {
 
  jQuery(window).scroll(function() {    
    var scroll = jQuery(window).scrollTop();

     //>=, not <=
    if (scroll >= 350) {
        //clearHeader, not clearheader - caps H
        jQuery("#menuid").addClass("fixed1");
		jQuery(".nav_bg").css("margin-bottom","0px");
	
    }
	else{
		jQuery("#menuid").removeClass('fixed1');
		jQuery(".nav_bg").css("margin-bottom","-30px");
	}
}); 
   
 }
headerAnimation();

  jQuery(document).ready(function() {
      var owl = jQuery('.owl-carousel');
              owl.owlCarousel({
                margin: 10,
                nav: true,
                loop: true,
                responsive: {
                  0: {
                    items: 1
                  },
				  
                  600: {
                    items: 3
                  },
                  1000: {
                    items: 4
                  }
                }
              })
			   jQuery( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
 jQuery( ".owl-next").html('<i class="fa  fa-angle-right "></i>');
            });			/* Mobile Menu */if ( jQuery(window).width() < 991 ){ jQuery( "body" ).addClass("MobileHeader");}