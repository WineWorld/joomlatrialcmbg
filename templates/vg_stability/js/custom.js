/**
    * @package Stability Responsive Joomla Template
    * 
    * Template Scripts
    * Created by Dan Fisher. Joomla version by Valentín García.

    Init JS
    
    1. Main Navigation
    2. Magnific Popup
    3. FitVid (responsive video)
    4. Sticky Header
    5. Shape Boxes
    6. SelfHosted Audio & Video
    7. Parallax Background
*/

jQuery(function($){



    /* ----------------------------------------------------------- */
    /*  1. Main Navigation
    /* ----------------------------------------------------------- */


    // Menu drop down effect
    jQuery('.dropdown-toggle').dropdownHover().dropdown();
    jQuery(document).on('click', '.fhmm .dropdown-menu', function(e) {
        e.stopPropagation()
    });
    
    jQuery(window).bind('load resize', function(){
        //console.log($(this).width());
        if(jQuery(this).width() <= 975){
            jQuery('.toogle-smenu').click(function(){
                jQuery(this).next('.dropdown-menu.small').toggleClass('enable-smenu');
                //console.log('clicked');
            });
        }
    });
    jQuery(document).on('click', '.toogle-smenu', function(e) {
        e.stopPropagation()
    });


    /* ----------------------------------------------------------- */
    /*  2. Isotope
    /* ----------------------------------------------------------- */

    /*(function($) {


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
       
    })(jQuery);*/



    /* ----------------------------------------------------------- */
    /*  2. Magnific Popup
    /* ----------------------------------------------------------- */
    jQuery('.popup-link').magnificPopup({
        type:'image',
        // Delay in milliseconds before popup is removed
        removalDelay: 300,

        // Class that is added to popup wrapper and background
        // make it unique to apply your CSS animations just to this exact popup
        mainClass: 'mfp-fade'
    });



    /* ----------------------------------------------------------- */
    /*  3. FitVid (responsive video)
    /* ----------------------------------------------------------- */
    jQuery(".video-holder, .audio-holder").fitVids();


    /* ----------------------------------------------------------- */
    /*  -- Misc
    /* ----------------------------------------------------------- */

    jQuery('.title-accent > h3').each(function(){
        var me = jQuery(this);
        me.html(me.html().replace(/^(\w+)/, '<span>$1</span>'));
    });

    // Animation on scroll
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (isMobile == false) {
        
        jQuery("[data-animation]").each(function() {

        var $this = jQuery(this);

        $this.addClass("animation");

        if(!jQuery("html").hasClass("no-csstransitions") && jQuery(window).width() > 767) {

            $this.appear(function() {

                var delay = ($this.attr("data-animation-delay") ? $this.attr("data-animation-delay") : 1);

                if(delay > 1) $this.css("animation-delay", delay + "ms");
                $this.addClass($this.attr("data-animation"));

                setTimeout(function() {
                    $this.addClass("animation-visible");
                }, delay);

            }, {accX: 0, accY: -170});

        } else {

            $this.addClass("animation-visible");

        }

    });  
    }


    /* ----------------------------------------------------------- */
    /*  4. Sticky Header
    /* ----------------------------------------------------------- */

    if(jQuery("body").hasClass("boxed"))
         return false;

    var header = jQuery("header.header"),
        headH = header.height(),
        headPadTop = jQuery(".header .header-top").outerHeight(),
        logoHolder = header.find(".logo"),
        logo = header.find(".logo img"),
        logoW = logo.attr("width"),
        logoH = logo.attr("height"),
        logoSmH = 28,
        $this = this;

    logo.css("height", logoSmH);

    var logoSmW = logo.width();
    logo.css("height", "auto").css("width", "auto");

    $this.stickyHeader = function() {

        if(header.hasClass("header-menu-fullw"))
            return false;

        if(jQuery(window).scrollTop() > (headPadTop) && jQuery(window).width() > 991) {

            if(jQuery("body").hasClass("sticky-header"))
                return false;

            logo.stop(true, true);

            jQuery("body").addClass("sticky-header").css("padding-top", headH);

            logoHolder.addClass("logo-sticky");

            logo.animate({
                width: logoSmW,
                height: logoSmH
            }, 300, function() {});

        } else {

            if(jQuery("body").hasClass("sticky-header")) {

                jQuery("body").removeClass("sticky-header").css("padding-top", 0);

                logoHolder.removeClass("logo-sticky");

                logo.animate({
                    width: logoW,
                    height: logoH,
                }, 300, function() {

                    logo.css({
                        width: "auto",
                        height: "auto"
                    });

                });
            }
        }
    }

    jQuery(window).on("scroll", function() {
        $this.stickyHeader();
    });
    $this.stickyHeader();



    /* ----------------------------------------------------------- */
    /*  5. Shape Boxes
    /* ----------------------------------------------------------- */
    function init() {
        var speed = 250,
            easing = mina.easeinout;

        [].slice.call ( document.querySelectorAll( '.shape-item' ) ).forEach( function( el ) {
            var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
                pathConfig = {
                    from : path.attr( 'd' ),
                    to : el.getAttribute( 'data-path-hover' )
                };

            el.addEventListener( 'mouseenter', function() {
                path.animate( { 'path' : pathConfig.to }, speed, easing );
            } );

            el.addEventListener( 'mouseleave', function() {
                path.animate( { 'path' : pathConfig.from }, speed, easing );
            } );
        } );
    }
    init();



    /* ----------------------------------------------------------- */
    /*  6. SelfHosted Audio & Video
    /* ----------------------------------------------------------- */
    jQuery('audio,video').mediaelementplayer({
        videoWidth: '100%',
        videoHeight: '100%',
        audioWidth: '100%',
        features: ['playpause','progress','tracks','volume'],
        videoVolume: 'horizontal'
    });

});



jQuery(window).load(function () {

    /* ----------------------------------------------------------- */
    /*  7. Parallax Background
    /* ----------------------------------------------------------- */
    if(jQuery(".parallax-bg").get(0) && jQuery(window).width() > 991) {
        if(!Modernizr.touch) {
            jQuery(window).stellar({
                responsive:true,
                scrollProperty: 'scroll',
                parallaxElements: false,
                horizontalScrolling: false,
                horizontalOffset: 0,
                verticalOffset: 0
            });
        } else {
            jQuery(".parallax-bg").addClass("disabled");
        }
    }
        
});