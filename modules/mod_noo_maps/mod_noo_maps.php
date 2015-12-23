<?php
/**
 * @version		$Id$
 * @author		NooTheme
 * @package		Joomla.Site
 * @subpackage	mod_noo_maps
 * @copyright	Copyright (C) 2013 NooTheme. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
$document = JFactory::getDocument();
//$document->addScript('http://maps.google.com/maps/api/js?sensor=true&language='.$params->get('lang','en-GB'));
$document->addScript('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language='.$params->get('lang','en-GB'));
$document->addScript('modules/mod_noo_maps/assets/js/script.js');
$document->addStyleSheet('modules/mod_noo_maps/assets/css/style.css');
$document->addScriptDeclaration('
	jQuery(document).ready(function($){
		$("#noo_m'.$module->id.'").noomap({
			address:"'.$params->get('address').'",
			description:"'.base64_encode($params->get('description')).'",
			zoom:'.$params->get('zoom',14).',
			latitude:"'.$params->get('latitude').'",
			longitude:"'.$params->get('longitude').'",
			language:"'.$params->get('lang','en-GB').'",
			infowindow:'.$params->get('alw_infowindow',1).',
			scrollwheel:'.$params->get('scrollwheel',1).',
			translates: {
				"DIRECTIONS": "'.JText::_('NOO_MAPS_DIRECTIONS').'",
				"STREET_VIEW": "'.JText::_('NOO_MAPS_STREET_VIEW').'",
				"GO": "'.JText::_('NOO_MAPS_GO').'",
				"FROM_ADDRESS": "'.JText::_('NOO_MAPS_FROM_ADDRESS').'"
			}
		});
	});
');

require (JModuleHelper::getLayoutPath('mod_noo_maps',$params->get('layout', 'default')));