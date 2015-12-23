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
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/isotope/jquery.isotope.min.js');
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/isotope/jquery.isotope.sloppy-masonry.min.js');
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/masonry.js');
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/masonry-sloppy.js');

echo '<div class="lastworks_masonry ' . $moduleclass_sfx . '">';
    
    if(count($articles)): //<-- A1.
        
            echo '<div class="clearfix">
				<ul class="project-feed-filter text-center">
                    <li><a href="#" class="btn btn-sm btn-default btn-primary" data-filter="*">' . JText::_('VG_ALL') . '</a></li>';
                
                foreach($categories as $category):
                    echo '<li><a href="#" class="btn btn-sm btn-default" data-filter=".mycat-' . $category->id . '">' . $category->title . '</a></li>';
                endforeach;
					
				echo '</ul>
			</div>';
            
            echo '<div class="project-feed project-feed__fullw">';
            
            foreach($articles as $article):
                
                $images = json_decode($article->images); 
                
                echo '<div class="project-item mycat-' . $article->catid . '">
					<div class="project-item-inner">
						<figure class="alignnone project-img">';
								
                            if( $images->image_intro ){
								echo '<img src="' . JURI::base() . $images->image_intro . '" alt="" />';
							}else{
								echo '<img src="' . JURI::base() . 'templates/' . $app->getTemplate() . '/images/carousel_default.jpg" alt="" />';
							}
							
                            echo '<div class="overlay">
								<a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '" class="dlink"><i class="fa fa-link"></i></a>';
                                
                                if( $images->image_fulltext ){
									echo '<a href="' . JURI::base() . $images->image_fulltext . '" class="popup-link zoom"><i class="fa fa-search-plus"></i></a>';
								}

							echo '</div>
						</figure>
					</div>
				</div>';
                
			endforeach;
            
			echo '</div>';
        
	else: // .A1
	
		echo '<p class="vg-alert">There are no articles for this module.</p>';
	
	endif; // .A1 -->
    
echo '</div>';
?>