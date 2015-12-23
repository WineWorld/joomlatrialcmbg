jQuery(function($){
      // Smooth scroll
      jQuery(document).ready(function() {
            jQuery('.navbar-collapse').bind('click', 'ul li a', function(e) {
                  e.preventDefault();
                  jQuery.scrollTo(e.target.hash, 600, {offset:-150});
            });
      });
});

window.addEventListener('DOMContentLoaded', function() {
      // Preloader
      jQuery("body").queryLoader2({
            barColor: "#2f2f2f",
            backgroundColor: "#f7f7f7",
            percentage: true,
            barHeight: 1,
            completeAnimation: "grow",
            minimumTime: 500,
            onLoadComplete: hidePreLoader
      });

      function hidePreLoader() {
            jQuery("#preloader-overlay").hide();
      }
});