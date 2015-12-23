/**
    * @package Stability Responsive Joomla Template
    * 
    * Template Scripts
    * Created by Dan Fisher. Joomla version by Valentín García.
*/

jQuery(function($){

    (function() {


        // Portfolio settings
        var $container          = jQuery('.masonry-feed');

        jQuery(window).smartresize(function(){
            $container.isotope({
                resizable           : true,
                layoutMode: 'sloppyMasonry',
                itemSelector: '.masonry-item'
            });
        });

        $container.imagesLoaded( function(){
            jQuery(window).smartresize();
        });
        
       
    })();
    
});