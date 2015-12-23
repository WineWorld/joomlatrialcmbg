<?php
/**
 * @autor       Valentín García
 * @website     www.htmgarcia.com
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2013 Valentín García. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

include_once JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_content' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'route.php';

// Include the syndicate functions only once
include_once dirname(__FILE__).'/helper.php';

//vars
$moduleclass_sfx 	= htmlspecialchars($params->get('moduleclass_sfx'));//suffix
$id_ 				= $module->id; //Moduleid
$categories 		= $params->get('vgcategories');
$filter 			= $params->get('vgfilter', 'any');
$orderingtype 		= $params->get('vgorderingtype', 'created');
$ordering 			= $params->get('vgordering', 'ASC' );
$limit 				= $params->get('vgnumarticles', 6 );
$layout 			= $params->get('vglayout', 'default');

//data
$articles 			= modLastWorksHelper::getArticlesLW( $categories, $filter, $orderingtype, $ordering, $limit );
if($categories){
	$categories 	= modLastWorksHelper::getCategoriesLW( $categories );
}

require JModuleHelper::getLayoutPath( 'mod_lastworks', $layout );
