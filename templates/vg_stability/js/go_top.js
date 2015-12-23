/**
    * @package Stability Responsive Joomla Template
    * 
    * Template Scripts
    * Created by Dan Fisher. Joomla version by Valentín García.
*/

jQuery(function($){

	// Back to Top
    jQuery("#back-top").hide();
    
    if(jQuery(window).width() > 991) {
        jQuery('body').append('<div id="back-top"><a href="#top"><i class="fa fa-chevron-up"></i></a></div>')
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('#back-top').fadeIn();
            } else {
                jQuery('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        jQuery('#back-top a').click(function(e) {
            e.preventDefault();
            jQuery('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });
    };
	
});