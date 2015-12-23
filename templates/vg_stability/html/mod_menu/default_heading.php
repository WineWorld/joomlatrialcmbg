<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$class = ' class="' . $class_dropdown_ . '" ';
$icon = $item->anchor_title ? '<i class="' . $item->anchor_title . '"></i> ' : '';
?>
<span <?php echo $class; ?>><?php echo $icon . $linktype . $caret_; ?></span>