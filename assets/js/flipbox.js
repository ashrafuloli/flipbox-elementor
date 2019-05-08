(function($) {
	"use strict";

	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/flipbox-pp.default', function () {

			$(".pp-flipbox-wrapper .pp-flipbox-flip-card > .pp-flipbox-front").on('click', function () {
				var parent_div = $(this).closest(".pp-flipbox-wrapper").addClass('active');
				parent_div.siblings().removeClass('active');
			});

			$(".pp-flipbox-wrapper .pp-flipbox-flip-card > .pp-flipbox-back .flipbox-close a").on('click', function (event) {
				event.preventDefault();
				$(this).closest(".pp-flipbox-wrapper").removeClass('active');
			});

		});
	});

})(window.jQuery);