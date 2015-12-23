/**
    * @package Stability Responsive Joomla Template
    * 
    * Template Scripts
    * Created by Dan Fisher. Joomla version by Valentín García.
*/

jQuery(function($){

    var owl = jQuery("#owl-carousel");

    owl.owlCarousel({
        items : 4, //4 items above 1000px browser width
        itemsDesktop : [1000,4], //4 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // 4 items betweem 900px and 601px
        itemsTablet: [600,2], //2 items between 600 and 0;
        itemsMobile : [480,1], // itemsMobile disabled - inherit from itemsTablet option
        pagination : false
    });

    // Custom Navigation Events
    jQuery("#carousel-next").click(function(){
        owl.trigger('owl.next');
    });
    jQuery("#carousel-prev").click(function(){
        owl.trigger('owl.prev');
    });
    
});