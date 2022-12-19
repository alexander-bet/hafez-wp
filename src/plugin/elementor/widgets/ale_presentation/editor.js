(function ($) {
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/hafez_presentation.default", function ($scope, $) {
      "use strict";

      if ($('.fadeInElement').length) {
        $('.fadeInElement').appear(function () {
          $(this).each(function () {
            $(this).addClass('animated');
          });
        }, { accX: 0, accY: -200 });
      }

    });
  });
})(jQuery);
