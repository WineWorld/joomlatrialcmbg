<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.vg_stability
 * @copyright	Copyright (C) 2014 Valentín García - http://www.htmgarcia.com - All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
 
 // No direct access.
defined('_JEXEC') or die;

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
	<title>404</title>
    
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
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/skins/red.css">
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/joomla.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/vendor/respond.min.js"></script>
	<![endif]-->

	<!--[if IE]>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/ie.css">
	<![endif]-->
	
	<link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Muli:300,400,400italic,300italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	
	<style>
	.header .logo h1,
	.header .logo h2,
	.tp-caption.stability_large_white,
	.tp-caption.stability_large_white_bg,
	.error-title,
	#qLpercentage,
	.title-accent > h3 > span
	{ 
		font-family: 'Anton', sans-serif;
	}body,
	.tp-caption.stability_verysmall_white_mw,
	.tp-caption.modern_medium_white,
	.widget .title,
	.panel-group .panel-title
	{ 
		font-family: 'Muli', sans-serif;
	}.fhmm .navbar-collapse .navbar-nav > li > a,
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
		font-family: 'Oswald', sans-serif;
	}
	</style>
	
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/apple-touch-icon-144x144.png">
	
</head>
<body class="page-404-error">

	<div class="site-wrapper">
		<!-- Main -->
		<div class="main" role="main">
            
            <!-- Page Heading -->
            <section class="page-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1><?php echo Jtext::_('VG_NOT_FOUND'); ?></h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Page Heading / End -->
            
            <!-- Page Content -->
			<section class="page-content">
				<div class="container">

					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center">
							<h2 class="error-title"><?php echo Jtext::_('VG_404'); ?></h2>
							<h3><?php echo Jtext::_('VG_404_SUBTITLE'); ?></h3>
							<p class="error-desc"><a class="btn btn-primary" href="<?php echo $this->baseurl; ?>">&raquo; <?php echo Jtext::_('VG_404_HOME'); ?></a></p>
						</div>
					</div>

					<div class="spacer-lg"></div>

				</div>
			</section>
			<!-- Page Content / End -->

		</div>
		<!-- Main / End -->
	</div>
    
</body>
</html>