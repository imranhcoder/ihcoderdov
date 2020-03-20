(function ($) {

"use strict";



 // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/ihcoderdov_slider.default',function($scope, $){
           
 			var pslider = $scope.find(".ihcoderdov_galley_slider");

			 if( pslider.length === 0 )
			    return;

			 var settings = pslider.data('settings');

			/*--------------------------------------------------------------
			DOOP PROMO SLIDER JS
			--------------------------------------------------------------*/
			$('.ihcoderdov_galley_slider').owlCarousel({
			    loop:true,
				nav:true,
				dots:false,
				mouseDrag:true,
				autoplay:false,
				autoplayTimeout:5000,
				items:3,
				margin:40,
				 navText: ["<i class=\"icon icon-left-arrow\"></i>",
        "<i class=\"icon icon-right-arrow\"></i>"],
			})
			// END JS SLIDER
			  
        });

    });

})(jQuery);











