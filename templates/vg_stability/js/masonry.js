/**
    * @package Stability Responsive Joomla Template
    * 
    * Template Scripts
    * Created by Dan Fisher. Joomla version by Valentín García.
*/

jQuery(function($){

    (function($) {


        // Portfolio settings
        var $container          = jQuery('.project-feed');
        var $filter             = jQuery('.project-feed-filter');

        jQuery(window).smartresize(function(){
            $container.isotope({
                filter              : '*',
                resizable           : true,
                layoutMode: 'sloppyMasonry',
                itemSelector: '.project-item'
            });
        });

        $container.imagesLoaded( function(){
            jQuery(window).smartresize();
        });

        // Filter items when filter link is clicked
        $filter.find('a').click(function() {
            var selector = jQuery(this).attr('data-filter');
            $filter.find('a').removeClass('btn-primary').addClass('btn-default');
            jQuery(this).addClass('btn-primary').removeClass('btn-default');
            $container.isotope({ 
                filter             : selector,
                animationOptions   : {
                animationDuration  : 750,
                easing             : 'linear',
                queue              : false
                }
            });
            return false;
        });
       
    })(jQuery);
    
});