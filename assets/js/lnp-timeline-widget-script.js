(function ($) {
  function initTimeline($scope) {
    const $container = $scope.find(".lnp-timeline");
    if (!$container.length || $container.data("timeline-inited")) return;
    // Mark as initialized to avoid double init on re-renders
    $container.data("timeline-inited", true);
    // Read per-instance options from data attributes (set in PHP)

    gsap.registerPlugin(ScrollTrigger);

    var $timelines = $container.find(".timeline-item");

    if (!$timelines.length) return;

    $timelines.each(function () {
      var $tl = $(this);
      var $progress = $tl.find(".progress");
      var $count = $tl.find(".timeline-count");

      if (!$progress.length) return;

      var countClrActive = "var(--count-clr--active, #fff)";
      var countBgClrActive = "var(--count-bg-clr--active, #000)";

      var gsapTl = gsap.timeline({
        scrollTrigger: {
          trigger: $tl,
          start: "top center",
          end: "bottom center",
          scrub: true,
          // toggleActions:'play none play reverse',
        },
      });

      gsapTl.to($count, {
        color: countClrActive,
        backgroundColor: countBgClrActive,
      });
      gsapTl.to($progress, { scaleY: 1 });
    });
  }

  // Elementor hook: fire when the specific widget is ready
  $(window).on("elementor/frontend/init", function () {
    // Replace "my-timeline" with your widget’s get_name()
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/lnp-timeline.default",
      initTimeline
    );
  });
})(jQuery);
