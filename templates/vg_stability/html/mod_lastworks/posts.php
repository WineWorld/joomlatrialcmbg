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

$count_ = 0;

echo '<div class="lastworks_posts ' . $moduleclass_sfx . '">
    <div class="latest-posts-widget widget widget__footer">
        <div class="widget-content">';
    
            if(count($articles)): //<-- A1.     
        
                echo '<ul class="latest-posts-list">';
                
                    foreach($articles as $article):
                    
                        echo '<li>';
                        
                            $images = json_decode($article->images); 
                            if( $images->image_intro ):
                                echo '<figure class="thumbnail"><a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '"><img src="' . JURI::base() . $images->image_intro . '" alt="' . htmlspecialchars( $article->title ) . '" /></a></figure>';
                            endif;

							echo '<span class="date">' . JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $article->publish_up, JText::_('DATE_FORMAT_LC2'))) . '</span>
							<h5 class="title"><a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '">' . $article->title . '</a></h5>
						</li>';
                    
                    endforeach;
            
                echo '</ul>';
		
            else: // .A1
	
                echo '<p class="vg-alert">There are no articles for this module.</p>';
	
            endif; // .A1 -->
    
        echo '</div>
    </div>
</div>';
?>