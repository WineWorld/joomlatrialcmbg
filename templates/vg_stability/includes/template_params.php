<?php

/********************************* LOGO **************************************/

if( $this->params->get( 'vg_logo_type' ) ){
	$vg_logo_type = $this->params->get( 'vg_logo_type' );
}else{
	$vg_logo_type = 'image';
}
	// image
	if( $this->params->get( 'vg_logo_image' ) ){
		$vg_logo_image = $this->baseurl . '/' . $this->params->get( 'vg_logo_image' );
	}else{
		$vg_logo_image = $this->baseurl . '/templates/' . $this->template . '/images/logo.png';
	}
	// text
	if( $this->params->get( 'vg_logo_text' ) ){
		$vg_logo_text = $this->params->get( 'vg_logo_text' );
	}else{
		$vg_logo_text = '';
	}
$vg_logo_subtext= $this->params->get( 'vg_logo_subtext' );

/********************************* BASIC **************************************/

$vg_analytics 	= $this->params->get( 'vg_analytics' );
$vg_css 		= $this->params->get( 'vg_css' );
$vg_copy 		= $this->params->get( 'vg_copy' );

/********************************** COLORS *************************************/

$vg_color 		= $this->params->get( 'vg_color', 'red' );

/********************************** FONTS *************************************/

$vg_fonts 		= $this->params->get( 'vg_fonts', 1 );
$vg_font1 		= $this->params->get( 'vg_font1', 'Anton' );
$vg_font2 		= $this->params->get( 'vg_font2', 'Muli:300,400,400italic,300italic' );
$vg_font3 		= $this->params->get( 'vg_font3', 'Oswald' );

/********************************** ICONS *************************************/

$vg_icon_favicon= $this->params->get( 'vg_icon_favicon',	$this->baseurl. '/templates/' . $this->template . '/images/favicon.ico' );
$vg_icon_57x57 	= $this->params->get( 'vg_icon_57x57', 		$this->baseurl. '/templates/' . $this->template . '/images/apple-touch-icon.png' );
$vg_icon_72x72 	= $this->params->get( 'vg_icon_72x72', 		$this->baseurl. '/templates/' . $this->template . '/images/apple-touch-icon-72x72.png' );
$vg_icon_114x114= $this->params->get( 'vg_icon_114x114',	$this->baseurl. '/templates/' . $this->template . '/images/apple-touch-icon-114x114.png' );
$vg_icon_144x144= $this->params->get( 'vg_icon_144x144',	$this->baseurl. '/templates/' . $this->template . '/images/apple-touch-icon-144x144.png' );

/********************************* ADVANCED ***********************************/

$vg_top 		= $this->params->get( 'vg_top', 1 );
$vg_layout 		= $this->params->get( 'vg_layout', 'full-width' );
$vg_body_image  = $this->params->get( 'vg_body_image' );
if( $vg_body_image ){
    $vg_body_image = 'background-image:url(' . $this->baseurl . '/' . $vg_body_image . ');';
}else{
    $vg_body_image = '';
}
//$vg_menuhome = $this->params->get( 'vg_menuhome', 1 );*/

?>