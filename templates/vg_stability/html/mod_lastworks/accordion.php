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

echo '<div class="lastworks_accordeon ' . $moduleclass_sfx . '">';
    
    if(count($articles)): //<-- A1.     
        
        echo '<div class="panel-group" id="accordion-mod-' . $id_ . '" data-animation="fadeInRight" data-animation-delay="0">';
                
            foreach($articles as $article):
                    
                if( $count_ == 0 ): 
                    $class_ = array(
                        'in',
                        ''
                    );
                else: 
                    $class_ = array(
                        '',
                        'collapsed'
                    );
                endif;
                    
                echo '<div class="panel panel-default">
                    <div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion-mod-' . $id_ . '" href="#accordion-mod-' . $id_ . '-art-' . $article->id . '" class="' . $class_[1] . '">' . $article->title . '</a>
						</h4>
					</div>
                    <div id="accordion-mod-' . $id_ . '-art-' . $article->id . '" class="panel-collapse collapse ' . $class_[0] . '">
						<div class="panel-body">';
							
                            $images = json_decode($article->images); 
                            if( $images->image_intro ):
                                echo '<div class="alignleft"><img src="' . JURI::base() . $images->image_intro . '" alt="" /></div>';
                            endif;
                        
                            echo '<div class="lastworks_accordeon_introtext">' . $article->introtext . '</div>';
                            
                            if( $article->fulltext ){
                                echo '<p><a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '" class="btn btn-default">' . JText::_('VG_READMORE') . '</a></p>';
                            }
                        
                        echo '</div>
					</div>
                </div>';
                $count_++;
            endforeach;
                
        echo '</div>';
		
	else: // .A1
	
		echo '<p class="vg-alert">There are no articles for this module.</p>';
	
	endif; // .A1 -->
    
echo '</div>';

$count_ = null;
?>