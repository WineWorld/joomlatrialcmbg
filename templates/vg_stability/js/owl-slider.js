/**
    * @package Stability Responsive Joomla Template
    * 
    * Template Scripts
    * Created by Dan Fisher. Joomla version by Valentín García.
*/

jQuery(function($){

    jQuery(".owl-slider").owlCarousel({

        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        navigationText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        pagination: true,
        autoPlay : false

    });
    
});