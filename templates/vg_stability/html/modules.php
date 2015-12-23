<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.vg_stability
 * @copyright	Copyright (C) 2014 Valentín García - http://www.htmgarcia.com - All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

//mymenu
function modChrome_mymenu($module, &$params, &$attribs){

	echo $module->content;
	
}

//top
function modChrome_top($module, &$params, &$attribs){

	echo $module->content;
	
}

//heading
function modChrome_heading($module, &$params, &$attribs){

	if( $module->showtitle ){
		echo '<div class="title-accent"><h3>' . $module->title . '</h3></div>';
	}
	
	echo $module->content;
	
}

//footer
function modChrome_footer($module, &$params, &$attribs){
    
    echo '<div class="widget__footer">';
	
        if( $module->showtitle ){
            echo '<h3 class="widget-title">' . $module->title . '</h3>';
        }
	
        echo $module->content;
        
    echo '</div>';
	
}

//showcase
function modChrome_showcase($module, &$params, &$attribs){

	if( $module->showtitle ){
		echo '<div class="title-accent"><h3>' . $module->title . '</h3></div>';
	}
	
	echo $module->content;
	
}

//slide
function modChrome_slide($module, &$params, &$attribs){
	
    //modules inside templates/thetemplate/html/
	$override_mods = array(
		'mod_unite_revolution2'
	);
    
	if( in_array($module->module, $override_mods) ){
		echo '<div class="tp-banner-holder">';
	}
	
	echo $module->content;
    
    if( in_array($module->module, $override_mods) ){
		echo '</div>';
	}
	
}
