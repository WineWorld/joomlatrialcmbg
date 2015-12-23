<?php
/**
 * @autor       Valentín García
 * @website     www.htmgarcia.com
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2014 Valentín García. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

//CSS and JS
$app 		= JFactory::getApplication();
$document   = JFactory::getDocument();
$document->addStylesheet(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/owl-carousel/owl.carousel.css');
$document->addStylesheet(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/owl-carousel/owl.theme.css');
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/owl-carousel/owl.carousel.min.js');
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/owl-slider.js');

echo '<div class="lastworks_testimonials ' . $moduleclass_sfx . '">
    <div class="owl-carousel owl-theme owl-slider owl-testi">';
    
    if(count($articles)): //<-- A1.
        
        foreach($articles as $article):
        
            echo '<div class="item">';
                
                $images = json_decode($article->images); 
                if( $images->image_intro ):
                    echo '<div class="aligncenter"><img src="' . JURI::base() . $images->image_intro . '" alt="' . htmlspecialchars( $article->title ) . '" /></div>';
                endif;
                
                echo '<div class="lastworks_testimonials_introtext">' . $article->introtext . '</div>';
                
                if( $article->fulltext ){
                    echo '<p><a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '" class="btn btn-default">' . JText::_('VG_READMORE') . '</a></p>';
				}
                        
            echo '</div>';
            
		endforeach;
        
	else: // .A1
	
		echo '<p class="vg-alert">There are no articles for this module.</p>';
	
	endif; // .A1 -->
    
    echo '</div>
</div>';
?>