<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.vg_stability
 * @copyright	Copyright (C) 2014 Valentín García - http://www.htmgarcia.com - All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
 
 // No direct access.
defined('_JEXEC') or die;

/****************************** IF DS DEPRECATED ******************************/

if( !defined('DS') ){
    define( 'DS', DIRECTORY_SEPARATOR );
}

/********************************* SITE DATA *********************************/

$app 		= JFactory::getApplication();
$sitename 	= $app->getCfg('sitename');
$itemid 	= JRequest::getVar('Itemid');
$menu 		= $app->getMenu();
$active 	= $menu->getItem($itemid);
$params 	= $menu->getParams(JRequest::getVar('Itemid'));
$pageclass 	= $params->get( 'pageclass_sfx' );

/****************************** MODULE POSITIONS ******************************/

require('includes' . DIRECTORY_SEPARATOR . 'module_positions.php');

/********************************* PARAMS *************************************/

require('includes' . DIRECTORY_SEPARATOR . 'template_params.php');

// Disable some js files and load again (this, to force to load for all pages always)
unset($this->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
unset($this->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
unset($this->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<script src="<?php echo $this->baseurl; ?>/media/jui/js/jquery.min.js"></script>
	<script src="<?php echo $this->baseurl; ?>/media/jui/js/jquery-migrate.min.js"></script>
	<script src="<?php echo $this->baseurl; ?>/media/jui/js/jquery-noconflict.js"></script>
	
	<jdoc:include type="head" />
	
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/fonts/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/magnific-popup/magnific-popup.css" media="screen">
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/mediaelement/mediaelementplayer.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/theme.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/theme-elements.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/animate.min.css">

	<!-- Skin CSS -->
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/skins/<?php echo $vg_color; ?>.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/joomla.css">
    
    <!-- OWL -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/owl-carousel/owl.theme.css">
    
	<!-- Head Libs -->
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/modernizr.js"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/respond.min.js"></script>
	<![endif]-->

	<!--[if IE]>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/ie.css">
	<![endif]-->
	
	<?php if( $vg_fonts ){ ?>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $vg_font1; ?>' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $vg_font2; ?>' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=<?php echo $vg_font3; ?>' rel='stylesheet' type='text/css'>
	<?php
	}
	
	$vg_font1 = explode( ':', $vg_font1 );
	echo '<style>
	.header .logo h1,
	.header .logo h2,
	.tp-caption.stability_large_white,
	.tp-caption.stability_large_white_bg,
	.error-title,
	#qLpercentage,
	.title-accent > h3 > span
	{ 
		font-family: \'' . str_replace('+', ' ', $vg_font1[0]) . '\', sans-serif;
	}';
	
	$vg_font2 = explode( ':', $vg_font2 );
	echo 'body,
	.tp-caption.stability_verysmall_white_mw,
	.tp-caption.modern_medium_white,
	.widget .title,
	.panel-group .panel-title
	{ 
		font-family: \'' . str_replace('+', ' ', $vg_font2[0]) . '\', sans-serif;
	}';
	
	$vg_font3 = explode( ':', $vg_font3 );
	echo '.fhmm .navbar-collapse .navbar-nav > li > a,
	.dropcap,
	.tp-caption.large_bold_white,
	.tp-caption.mediumwhitebg,
	.tp-caption.finewide_small_white,
	.rsThumb,
	.ls-caption1,
	.ls-caption3,
	table.cart-total > tbody > tr > th,
	.bbp-forums .bbp-header .forum-titles,
	.bbp-replies .bbp-body .bbp-reply-author .bbp-author-name,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.h1,
	.h2,
	.h3,
	.h4,
	.h5,
	.h6,
	.btn-default,
	.btn-primary,
	.btn-success,
	.btn-info,
	.btn-warning,
	.btn-danger,
	.table > thead > tr > th,
	.pricing-table .plan .pricing-head .price,
	.progress-label
	{ 
		font-family: \'' . str_replace('+', ' ', $vg_font3[0]) . '\', sans-serif;
	}
	</style>';
	?>
	
	<style><?php echo $vg_css; ?></style>
	
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo $vg_icon_favicon; ?>">
	<link rel="apple-touch-icon" href="<?php echo $vg_icon_57x57; ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $vg_icon_72x72; ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $vg_icon_114x114; ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $vg_icon_144x144; ?>">
	
</head>
<body class="<?php echo $pageclass . ' ' . $vg_layout; ?>" style="<?php echo $vg_body_image; ?>">

	<div class="site-wrapper">
		
		<!-- Header -->
		<header class="header header-default">
            
            <?php if( $this->countModules('top-a') or $this->countModules('top-b') ):// <-- TOP ?>
			
                <div class="header-top">
                    <div class="container">
                        <?php if( $this->countModules('top-a') )://<-- TOP-A ?>
                            <div class="header-top-left">
                                <jdoc:include type="modules" name="top-a" style="showcase" />
                            </div>
                        <?php endif;//TOP-A --> ?>
                    
                        <?php if( $this->countModules('top-b') )://<-- TOP-A ?>
                            <div class="header-top-right">
                                <jdoc:include type="modules" name="top-b" style="showcase" />
                            </div>
                        <?php endif;//TOP-A --> ?>
                    </div>
                </div>
            
            <?php endif;//TOP --> ?>
            
			<div class="header-main">
				<div class="container">
					<nav class="navbar navbar-default fhmm" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
								<i class="fa fa-bars"></i>
							</button>
							<!-- Logo -->
							<div class="logo">
								<?php if( $vg_logo_type == 'image' ): ?>
									<a href="<?php echo JURI::base(); ?>"><img src="<?php echo $vg_logo_image; ?>" alt="<?php echo htmlspecialchars( $sitename ); ?>" /></a>
								<?php else: ?>
									<h1><a href="<?php echo JURI::base(); ?>"><?php echo $vg_logo_text; ?></a></h1>
								<?php endif; ?>
								<p class="tagline"><?php echo $vg_logo_subtext; ?></p>
							</div>
							<!-- Logo / End -->
						</div><!-- end navbar-header -->

						<div id="main-nav" class="navbar-collapse collapse">
							<?php if( $this->countModules('menu') )://START MAIN MENU ?>
								<jdoc:include type="modules" name="menu" style="mymenu" />
							<?php else: ?>
								<p class="vg-alert"><?php echo JText::_('VG_MENU_ALERT'); ?></p>
							<?php endif;//END MAIN MENU ?>
						</div><!-- end #main-nav -->

					</nav><!-- end navbar navbar-default fhmm -->
				</div>
			</div>
			
		</header>
		<!-- Header / End -->

		
		<?php if( $this->countModules('slide') )://<-- SLIDE ?>
            <div class="main">

                <section class="slide-content">
                    <jdoc:include type="modules" name="slide" style="slide" />
                </section>
            
            </div>
        <?php endif;//SLIDE --> ?>
        
        <!-- Main -->
        <div class="main" role="main">
        
			<!-- Page Content -->
			<section class="page-content">
				<div class="container">
					
                    <div class="row" id="vg-maincontent">
                        
                        <?php if( $this->countModules('bodyleft') )://<-- BODYLEFT ?>
                            <aside class="sidebar <?php echo $bodysidebar[0]; ?>">
                                <jdoc:include type="modules" name="bodyleft" style="heading" />
                            </aside>
                        <?php endif;//BODYLEFT --> ?>
                        
                        <div class="<?php echo $bodysidebar[1]; ?>">
                            <?php if(count($app->getMessageQueue())) : ?>
                                <jdoc:include type="message" />
                            <?php endif; ?>
                            <jdoc:include type="component" />
                        </div>
                        
                        <?php if( $this->countModules('bodyright') )://<-- BODYRIGHT ?>
                            <aside class="sidebar col-md-offset-1 col-bordered <?php echo $bodysidebar[2]; ?>">
                                <jdoc:include type="modules" name="bodyright" style="heading" />
                            </aside>
                        <?php endif;//BODYRIGHT --> ?>
                        
                    </div>
                    
					<?php if( $this->countModules('showcase-a') or $this->countModules('showcase-b') or $this->countModules('showcase-c') ):// <-- SHOWCASE ?>
			
						<div class="row" id="vg-showcase-1">
							<?php if( $this->countModules('showcase-a') )://<-- SHOWCASE-A ?>
								<div class="<?php echo $showcase; ?>">
									<jdoc:include type="modules" name="showcase-a" style="heading" />
								</div>
							<?php endif;//SHOWCASE-A --> ?>
							<?php if( $this->countModules('showcase-b') )://<-- SHOWCASE-B ?>
								<div class="<?php echo $showcase; ?>">
									<jdoc:include type="modules" name="showcase-b" style="heading" />
								</div>
							<?php endif;//SHOWCASE-B --> ?>
							<?php if( $this->countModules('showcase-c') )://<-- SHOWCASE-C ?>
								<div class="<?php echo $showcase; ?>">
									<jdoc:include type="modules" name="showcase-c" style="heading" />
								</div>
							<?php endif;//SHOWCASE-C --> ?>
						</div>
		
					<?php endif;//SHOWCASE --> ?>
					
                    <?php if( $this->countModules('full-top') ):// <-- BANNER ?>
                        
                        <div class="portfolio-sidebar-bottom">
                            <jdoc:include type="modules" name="full-top" style="heading" />
                        </div>
                        
                    <?php endif;//BANNER --> ?>
                
					<?php if( $this->countModules('showcase-d') or $this->countModules('showcase-e') or $this->countModules('showcase-f') ):// <-- SHOWCASE ?>
					
                        <section class="section-dark" data-animation="fadeInUp">
                            <div class="row" id="vg-showcase-2">
                                <?php if( $this->countModules('showcase-d') )://<-- SHOWCASE-D ?>
                                    <div class="<?php echo $showcase2; ?>">
                                        <jdoc:include type="modules" name="showcase-d" style="showcase" />
                                    </div>
                                <?php endif;//SHOWCASE-D --> ?>
                                <?php if( $this->countModules('showcase-e') )://<-- SHOWCASE-E ?>
                                    <div class="<?php echo $showcase2; ?>">
                                        <jdoc:include type="modules" name="showcase-e" style="showcase" />
                                    </div>
                                <?php endif;//SHOWCASE-E --> ?>
                                <?php if( $this->countModules('showcase-f') )://<-- SHOWCASE-F ?>
                                    <div class="<?php echo $showcase2; ?>">
                                        <jdoc:include type="modules" name="showcase-f" style="showcase" />
                                    </div>
                                <?php endif;//SHOWCASE-F --> ?>
                            </div>
                        </section>
                        
					<?php endif;//SHOWCASE --> ?>
					
                    <?php if( $this->countModules('bottom-a') or $this->countModules('bottom-b') or $this->countModules('bottom-c') or $this->countModules('bottom-d') ):// <-- BOTTOM ?>
                            
                        <div class="row">
                            <?php if( $this->countModules('bottom-a') )://<-- BOTTOM-A ?>
                                <div class="<?php echo $bottom; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-a" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-A --> ?>
                            
                            <?php if( $this->countModules('bottom-b') )://<-- BOTTOM-B ?>
                                <div class="<?php echo $bottom; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-b" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-B --> ?>
                            
                            <?php if( $this->countModules('bottom-c') )://<-- BOTTOM-C ?>
                                <div class="<?php echo $bottom; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-c" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-C --> ?>
                            
                            <?php if( $this->countModules('bottom-d') )://<-- BOTTOM-D ?>
                                <div class="<?php echo $bottom; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-d" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-D --> ?>
                        </div>
                        <hr class="lg no-top-margin">
                        
                    <?php endif;//BOTTOM --> ?>
                    
                    <?php if( $this->countModules('inner') ):// <-- BANNER ?>
                        
                        <div class="row" data-animation="fadeInUp">
                            <jdoc:include type="modules" name="inner" style="heading" />
                        </div>
                        
					<?php endif;//BANNER --> ?>
                    
                    <?php if( $this->countModules('bottom-e') or $this->countModules('bottom-f') or $this->countModules('bottom-g') or $this->countModules('bottom-h') ):// <-- BOTTOM ?>
                            
                        <div class="row">
                            <?php if( $this->countModules('bottom-e') )://<-- BOTTOM-E ?>
                                <div class="<?php echo $bottom2; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-e" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-E --> ?>
                            
                            <?php if( $this->countModules('bottom-f') )://<-- BOTTOM-F ?>
                                <div class="<?php echo $bottom2; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-f" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-F --> ?>
                            
                            <?php if( $this->countModules('bottom-g') )://<-- BOTTOM-G ?>
                                <div class="<?php echo $bottom2; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-g" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-G --> ?>
                            
                            <?php if( $this->countModules('bottom-h') )://<-- BOTTOM-H ?>
                                <div class="<?php echo $bottom2; ?>" data-animation="fadeInDown">
                                    <jdoc:include type="modules" name="bottom-h" style="heading" />
                                </div>
                            <?php endif;//BOTTOM-H --> ?>
                        </div>
                        
                    <?php endif;//BOTTOM --> ?>
                
                </div>
                
                <?php if( $this->countModules('full') ):// <-- BANNER ?>
                        
                    <div class="portfolio-sidebar-bottom">
                        <jdoc:include type="modules" name="full" style="heading" />
                    </div>
                        
				<?php endif;//BANNER --> ?>
                
                <div class="container">
                
                    <?php if( $this->countModules('banner') ):// <-- BANNER ?>
                        
                        <section class="section-light section-bottom" data-animation="fadeInUp">
                            <jdoc:include type="modules" name="banner" style="heading" />
                        </section>
                        
					<?php endif;//BANNER --> ?>
                    
				</div>
			</section>
			<!-- Page Content / End -->
            
            <?php if( $this->countModules('footer-a') or $this->countModules('footer-b') or $this->countModules('footer-c') or $this->countModules('footer-d') ):// <-- BOTTOM ?>
                
                <footer class="footer" id="footer">
                    <div class="footer-widgets">
                        <div class="container">
                            <div class="row">
                                <?php if( $this->countModules('footer-a') )://<-- FOOTER-A ?>
                                    <div class="<?php echo $footer; ?>" data-animation="fadeInDown">
                                        <jdoc:include type="modules" name="footer-a" style="footer" />
                                    </div>
                                <?php endif;//FOOTER-A --> ?>
        
                                <?php if( $this->countModules('footer-b') )://<-- FOOTER-B ?>
                                    <div class="<?php echo $footer; ?>" data-animation="fadeInDown">
                                        <jdoc:include type="modules" name="footer-b" style="footer" />
                                    </div>
                                <?php endif;//FOOTER-B --> ?>
        
                                <?php if( $this->countModules('footer-c') )://<-- FOOTER-C ?>
                                    <div class="<?php echo $footer; ?>" data-animation="fadeInDown">
                                        <jdoc:include type="modules" name="footer-c" style="footer" />
                                    </div>
                                <?php endif;//FOOTER-C --> ?>
        
                                <?php if( $this->countModules('footer-d') )://<-- FOOTER-D ?>
                                    <div class="<?php echo $footer; ?>" data-animation="fadeInDown">
                                        <jdoc:include type="modules" name="footer-d" style="footer" />
                                    </div>
                                <?php endif;//FOOTER-D --> ?>
                            </div>
                        </div>
                    </div>
                </footer>
                
            <?php endif;//FOOTER --> ?>
			
            <?php if( $vg_copy )://<-- FOOTER1 ?>
                <footer class="footer" id="footer2">
                    <div class="footer-copyright">
                        <div class="container">
                            <?php echo $vg_copy; ?>
                        </div>
                    </div>
                </footer>
            <?php endif;//FOOTER2 --> ?>
            
		</div>
		<!-- Main / End -->
	</div>
	
	<!-- Javascript Files
	================================================== -->
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/bootstrap.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/bootstrap-hover-dropdown.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/jquery.hoverIntent.minified.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/jquery.flickrfeed.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/isotope/jquery.imagesloaded.min.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/magnific-popup/jquery.magnific-popup.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/jquery.fitvids.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/jquery.appear.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/jquery.stellar.min.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/snap.svg-min.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/mediaelement/mediaelement-and-player.min.js"></script>
    <script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/owl-slider.js"></script>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/custom.js"></script>
	<?php if( $vg_top ){ ?>
		<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/go_top.js"></script>
	<?php } ?>

	<jdoc:include type="modules" name="debug" style="none" />
    
    <?php echo $vg_analytics; ?>
    
</body>
</html>