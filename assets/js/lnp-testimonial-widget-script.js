(function ($) {
  function initTestimonial($scope) {
    const $container = $scope.find(".lnp-testimonial");
    if (!$container.length || $container.data("testimonial-inited")) return;
    // Mark as initialized to avoid double init on re-renders
    $container.data("testimonial-inited", true);
    // Read per-instance options from data attributes (set in PHP)
    if ($container.hasClass("slider") && Swiper) {
      console.log("slider init");
      var toShow = Number($container.attr("data-slide-to-show"));
      var toScroll = Number($container.attr("data-slide-to-scroll"));
      var paginationType = $container.attr("data-pagination-type");
      var slideAutoplay = $container.attr("data-autoplay") ? true : false;
      var infiniteLoop = $container.attr("data-infinite-loop") ? true : false;
      var autplaySpeed = Number($container.attr("data-autoplay-speed"));
      var animationSpeed = Number($container.attr("data-animation-speed"));
      var pauseOnHover = $container.attr("data-pause-on-hover") ? true : false;
      var pauseOnInteraction = $container.attr("data-pause-on-interaction")
        ? true
        : false;
      var prevArr = $container.find(".slider-button-prev");
      var nextArr = $container.find(".slider-button-next");
      var pagination = $container.find(".swiper-pagination");

      const options = {
        slidesPerView: toShow,
        slidesPerGroup: toScroll,
        spaceBetween: 30,
        speed: animationSpeed,
        loop: !!infiniteLoop,
      };

      if (slideAutoplay) {
        options.autoplay = {
          delay: autplaySpeed,
          disableOnInteraction: pauseOnInteraction,
          pauseOnMouseEnter: pauseOnHover,
        };
      }

      if (nextArr && nextArr[0] && prevArr && prevArr[0]) {
        options.navigation = {
          nextEl: nextArr[0],
          prevEl: prevArr[0],
        };
      }

      if (
        pagination &&
        pagination[0] &&
        paginationType &&
        paginationType !== "none"
      ) {
        options.pagination = {
          el: pagination[0],
          clickable: true,
          type: paginationType, // 'bullets' | 'fraction' | 'progressbar'
        };
      }
      const testimonialSlider = new Swiper($container[0], options);
    }
  }

  // Elementor hook: fire when the specific widget is ready
  $(window).on("elementor/frontend/init", function () {
    // Replace "my-timeline" with your widget’s get_name()
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/lnp-testimonial.default",
      initTestimonial
    );
  });
})(jQuery);
