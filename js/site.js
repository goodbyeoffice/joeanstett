/**
 * site.js
 *
 * Various scripts for the Joe Anstett wordpress theme.
 */
 
// Because the Wordpress jQuery is loaded in no conflict mode, and I am too lazy not to use $
var $ = jQuery.noConflict();


/* Sticky footer underneath the project descriptions
 * Depreciated for a pure CSS solution: https://css-tricks.com/snippets/css/sticky-footer/

$(function() {
    if ($("#home_button").length) {
        var footerHeight = $("#home_button").height() + 15;
        $(".site-branding").css("margin-bottom", -footerHeight);
        $(".push").css("height", footerHeight);
    }
});

$(window).resize(function() {
    if ($("#home_button").length) {
        var footerHeight = $("#home_button").height() + 15;
        $(".site-branding").css("margin-bottom", -footerHeight);
        $(".push").css("height", footerHeight);
    }
});

*/

// Prep a color array from the project background colors
var colors = [];
$(".project-square").each(function(){
	colors.push( $(this).css("background-color") );
});



$( document ).ready(function() {
	
	// Strobe Text set-up
	if (!Modernizr.touchevents) {
		$("#main-header-text a").hover(
			function() {
				$(this).addClass('strobe-text');
				interval = window.setInterval(strobe, 80);
			},
			function() {
				window.clearInterval(interval);
				$(this).removeClass('strobe-text');
				$(this).css('color', '#fff');
				$(this).css({
					'-webkit-transform': 'rotate(0deg) scale(1,1)',
					'-moz-transform': 'rotate(0deg) scale(1,1)',
					'-ms-transform': 'rotate(0deg) scale(1,1)',
					'-o-transform': 'rotate(0deg) scale(1,1)',
					'transform': 'rotate(0deg) scale(1,1)',
				});
			}
		);
	}
	
	roundPercentageHeights();
	linkedScrolling();
	
	// Find all external links and add a target="_blank"
	$('a').each(function() {
	   var a = new RegExp('/' + window.location.host + '/');
	   if(!a.test(this.href)) {
		   $(this).click(function(event) {
			   event.preventDefault();
			   event.stopPropagation();
			   window.open(this.href, '_blank');
		   });
	   }
	});

});

$(window).on('resize', function(){

	roundPercentageHeights();
	linkedScrolling();
	
});


$(window).scroll(function () {

	linkedScrolling();

});


// So it looks like the combination of: percentage widths (resulting in a non-integer pixel width) + scaled background image + css step sprite animation
// causes annoying jitter in Chrome/Firefox. The solution is to force an integer width/height to the animation containter (.project-square-bg) for a
// properly aligned, clean animation.
function roundPercentageHeights() {
	$(".project-square-bg").each(function(){
		$(this).css("height", "" ).css("width", "" );
		var roundedHeight = Math.round( $(this).height() ) + 1;
		$(this).css("height", roundedHeight + "px" ).css("width", roundedHeight + "px" );
	})
}

function strobe() {
	var scale = getRandomArbitrary(0.95, 1.05);
	var rotate = getRandomArbitrary(-1, 1);
	$('.strobe-text').css('color', colors[getRandomInt(0, colors.length)] );
	$('.strobe-text').css({
		'-webkit-transform': 'rotate(' + rotate + 'deg) scale(' + scale + ',' + scale + ')',
		'-moz-transform': 'rotate(' + rotate + 'deg) scale(' + scale + ',' + scale + ')',
		'-ms-transform': 'rotate(' + rotate + 'deg) scale(' + scale + ',' + scale + ')',
		'-o-transform': 'rotate(' + rotate + 'deg) scale(' + scale + ',' + scale + ')',
		'transform': 'rotate(' + rotate + 'deg) scale(' + scale + ',' + scale + ')',
	});
}


// Adapted from: https://perma.cc/8WSN-T2K3
function linkedScrolling() {
	var winTop = $(window).scrollTop(),
		winBottom = winTop + $(window).height(),
		left = $('#masthead'),
		leftBottom = left.outerHeight();
	// When the user reaches the bottom of '#masthead' set its position to fixed
	// to prevent it from moving on scroll
	if (winBottom >= leftBottom) {
		left.css({
			'position': 'fixed',
			'bottom': '0px'
		});
	} else {
		//when the user scrolls back up revert its position to relative
		// to make it move up together with '#rightLong'
		left.css({
			'position': 'relative',
			'bottom': 'auto'
		});
	}
}


/* Utility functions */

function getRandomArbitrary(min, max) {
	return Math.random() * (max - min) + min;
}

function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}