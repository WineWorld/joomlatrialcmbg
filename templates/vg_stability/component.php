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
<body class="<?php echo $pageclass; ?>">

	<div class="site-wrapper">
		
		<!-- Main -->
		<div class="main tp-banner-holder-" role="main">

			<!-- Page Content -->
			<section class="page-content">
				<div class="container">
					
                    <div class="row" id="vg-maincontent">
                        
                        <div class="col-md-12">
                            <?php if(count($app->getMessageQueue())) : ?>
                                <jdoc:include type="message" />
                            <?php endif; ?>
                            <jdoc:include type="component" />
                        </div>
                        
                    </div>
                    
                </div>
            </section>
            <!-- Page Content / End -->
            
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

	<?php echo $vg_analytics; ?>
    
</body>
</html>