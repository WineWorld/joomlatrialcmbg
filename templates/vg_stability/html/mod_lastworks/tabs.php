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

echo '<div class="lastworks_tabs ' . $moduleclass_sfx . '">';
    
    if(count($articles)): //<-- A1.     
        
        echo '<div class="tabs">
            <ul class="nav nav-tabs">';
                
                foreach($articles as $article):
                    
                    if( $count_ == 0 ): 
                        $class_ = 'active'; 
                    else: 
                        $class_ = '';
                    endif;
                    
                    echo '<li class="' . $class_ . '"><a href="#tab-mod-' . $id_ . '-art-' . $article->id . '" data-toggle="tab">' . $article->title . '</a></li>';
                    $count_++;
                endforeach;
                
            echo '</ul>';
				
            $count_ = 0;
            
            echo '<div class="tab-content">';
                
                foreach($articles as $article):
                    
                    if( $count_ == 0 ): 
                        $class_ = 'active'; 
                    else: 
                        $class_ = '';
                    endif;
                    
                    echo '<div class="tab-pane fade in ' . $class_ . '" id="tab-mod-' . $id_ . '-art-' . $article->id . '">';
                        
                        $images = json_decode($article->images); 
                        if( $images->image_intro ):
                            echo '<div class="alignleft"><img src="' . JURI::base() . $images->image_intro . '" alt="" /></div>';
                        endif;
                    
                        echo '<div class="lastworks_tabs_introtext">' . $article->introtext . '</div>';
                        
                        if( $article->fulltext ){
							echo '<p><a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '" class="btn btn-default">' . JText::_('VG_READMORE') . '</a></p>';
						}
                                    
                    echo '</div>';
                    $count_++;
                endforeach;
            
            echo '</div>
        </div>';
		
	else: // .A1
	
		echo '<p class="vg-alert">There are no articles for this module.</p>';
	
	endif; // .A1 -->
    
echo '</div>';

$count_ = null;
?>