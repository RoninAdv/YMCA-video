jQuery(document).ready(function($) {

	/****************************************
	* Mobile Navigation
	****************************************/

	// Mobile Navigation Toggle
	$(function() {
		$('.toggle-nav').click(function() {
			toggleNav();
		});
	});

	function toggleNav() { 
		if ($('#page').hasClass('show-nav')) {
			$('#page').removeClass('show-nav');
		} else {
			$('#page').addClass('show-nav');
		}
		// if ($('#page').hasClass('show-nav')) {
		// 	// $('#page').click(function() {
		// 	// 	$('#page').removeClass('show-nav');
		// 	// });
		// }
	}
 
	// Mobile Contact Toggle
	$(function() {
		$('.toggle-contact').click(function() {
			toggleContact();
		});
	});

	// function toggleContact() {
	// 	if ($('#site-wrap').hasClass('show-contact')) {
	// 		$('#site-wrap').removeClass('show-contact');
	// 	} else {
	// 		$('#site-wrap').addClass('show-contact');
	// 	}
	// 	// if ($('#site-wrap').hasClass('show-contact')) {
	// 	// 	$('#page').click(function() {
	// 	// 		$('#site-wrap').removeClass('show-contact');
	// 	// 	});
	// 	// }
	// }

	// Hide nav/contact if open and window is resized above 760
	$(window).resize(function () {
		if ($(window).width() > 760) {
			$('#page').removeClass('show-nav');
			$('#page').removeClass('show-contact');
		}
	});

	// Mobile navigation 2nd/3rd level toggles
	$('.mobile-nav li.menu-item-has-children a').one('click', function(navclick) {
	
		console.log('yup');
		navclick.preventDefault();
	
		var target = $(this).siblings('.mobile-nav li > .sub-menu');
		var target2 = $(this).siblings('.sub-menu li .sub-menu');
	
		target.slideDown('800');
		target2.slideDown('800');
	
	});

}); /* end doc ready */
